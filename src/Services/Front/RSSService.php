<?php

namespace InetStudio\RSS\Services\Front;

use Roumen\Feed\Feed;
use InetStudio\RSS\Contracts\Services\Front\RSSServiceContract;

/**
 * Class RSSService.
 */
class RSSService implements RSSServiceContract
{
    /**
     * Формируем фид.
     *
     * @param string $type
     * @param array $params
     *
     * @return Feed
     */
    public function feed(string $type, array $params)
    {
        $config = $params['config'];
        $limit = $params['limit'];
        $offset = $params['limit'];

        $feed = new Feed;

        $feed->setCache(60, 'feed_'.$type.'_'.$offset.'_'.$limit);

        if (! $feed->isCached()) {
            $items = [];
            foreach ($config['sources'] as $source) {
                $items = array_merge($items, $this->getItems($source));
            }

            $items = collect($items)->sortByDesc('pubdate');

            $items = ($limit) ? $items->slice($offset, $limit) : $items->slice($offset);

            $feed->title = (isset($config['feed']['title'])) ? $config['feed']['title'] : config('app.name');
            $feed->description = (isset($config['feed']['description'])) ? $config['feed']['description'] : '';
            $feed->link = $params['url'];

            $feed->setDateFormat((isset($config['feed']['dateformat'])) ? $config['feed']['dateformat'] : 'datetime');
            $feed->pubdate = ($items->count() > 0) ? $items->first()['pubdate'] : time();
            $feed->lang = (isset($config['feed']['language'])) ? $config['feed']['language'] : 'ru';
            $feed->setShortening(true);
            $feed->setTextLimit(100);

            foreach ($items as $item)
            {
                $feed->add($item['title'], $item['author'], $item['link'], $item['pubdate'], $this->fixBadText($item['description']), $this->fixBadText($item['content']));
            }
        }

        if (isset($config['feed']['view'])) {
            $feed->setView($config['feed']['view']);
        }

        if (isset($config['feed']['type'])) {
            $feed->ctype = $config['feed']['type'];
        }

        return $feed;
    }

    /**
     * Получаем материалы.
     *
     * @param $source
     *
     * @return mixed
     */
    private function getItems($source)
    {
        $resolver = array_wrap($source);

        $items = app()->call(
            array_shift($resolver), $resolver
        );

        return $items;
    }

    /**
     * Вырезаем из текста битые символы.
     *
     * @param $text
     *
     * @return null|string|string[]
     */
    private function fixBadText($text)
    {
        return preg_replace('/[\x00-\x1F\x7F]/', '', $text);
    }
}
