<?php

namespace InetStudio\RSS\Feeds\Services\Front;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\RSS\Feeds\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService implements ItemsServiceContract
{
    /**
     * Формируем фид.
     *
     * @param  string  $type
     * @param  array  $params
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function feed(string $type, array $params)
    {
        $config = $params['config'];
        $limit = $params['limit'];
        $offset = $params['limit'];

        $feed = app()->make('feed');

        $feed->setCache(60, 'feed_'.$type.'_'.$offset.'_'.$limit);

        if (! $feed->isCached()) {
            $items = [];
            foreach ($config['sources'] as $source) {
                $items = array_merge($items, $this->getItems($source));
            }

            $items = collect($items)->sortByDesc('pubdate');

            $items = ($limit) ? $items->slice($offset, $limit) : $items->slice($offset);

            $feed->title = $config['feed']['title'] ?? config('app.name');
            $feed->description = $config['feed']['description'] ?? '';
            $feed->link = $params['url'];

            $feed->setDateFormat($config['feed']['dateformat'] ?? 'datetime');
            $feed->pubdate = ($items->count() > 0) ? $items->first()['pubdate'] : time();
            $feed->lang = $config['feed']['language'] ?? 'ru';
            $feed->setShortening(true);
            $feed->setTextLimit(100);

            foreach ($items as $item) {
                $feed->add(
                    $item['title'],
                    $item['author'],
                    $item['link'],
                    $item['pubdate'],
                    $this->fixBadText($item['description']), $this->fixBadText($item['content'])
                );
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
     * Выводим кастомный фид.
     *
     * @param  string  $vendor
     * @param  string  $type
     *
     * @return array
     */
    public function getCustomData(string $vendor, string $type = ''): array
    {
        $config = config('rss.'.$vendor.'.'.$type);

        $items = collect([]);
        foreach ($config['sources'] as $source) {
            $items = $items->merge($this->getItems($source));
        }

        return $items->toArray();
    }

    /**
     * Получаем материалы.
     *
     * @param $source
     *
     * @return mixed
     */
    protected function getItems($source)
    {
        $resolver = Arr::wrap($source);

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
    protected function fixBadText($text)
    {
        return preg_replace('/[\x00-\x1F\x7F]/', '', $text);
    }
}
