<?php

namespace InetStudio\RSS\Http\Controllers\Front;

use Roumen\Feed\Feed;
use App\Http\Controllers\Controller;

/**
 * Контроллер для управления фидами.
 *
 * Class RSSController
 */
class RSSController extends Controller
{
    public function feed(string $type = '')
    {
        $config = config('rss.'.$type);

        if (! $config) {
            return '';
        }

        $feed = new Feed;

        $feed->setCache(60, 'feed_'.$type);

        if (! $feed->isCached()) {
            $items = [];
            foreach ($config['sources'] as $source) {
                $items = array_merge($items, $this->getItems($source));
            }

            $items = collect($items)->sortByDesc('publish_date');

            if (isset($config['feed']['limit'])) {
                $items = $items->take($config['feed']['limit']);
            }

            $feed->title = (isset($config['feed']['title'])) ? $config['feed']['title'] : config('app.name');
            $feed->description = (isset($config['feed']['description'])) ? $config['feed']['title'] : '';
            $feed->link = route('front.rss.feed', [
                'type' => $type,
            ]);

            $feed->setDateFormat((isset($config['feed']['dateformat'])) ? $config['feed']['dateformat'] : 'datetime');
            $feed->pubdate = ($items->count() > 0) ? $items->first()['pubdate'] : time();
            $feed->lang = (isset($config['feed']['language'])) ? $config['feed']['language'] : 'ru';
            $feed->setShortening(true);
            $feed->setTextLimit(100);

            foreach ($items as $item)
            {
                $feed->add($item['title'], $item['author'], $item['link'], $item['pubdate'], $item['description'], $item['content']);
            }
        }

        if (isset($config['feed']['view'])) {
            $feed->setView($config['feed']['view']);
        }

        if (isset($config['feed']['type'])) {
            $feed->ctype = $config['feed']['type'];
        }

        return $feed->render('rss');
    }

    private function getItems($source)
    {
        $resolver = array_wrap($source);

        $items = app()->call(
            array_shift($resolver), $resolver
        );

        return $items;
    }
}
