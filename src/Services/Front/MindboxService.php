<?php

namespace InetStudio\RSS\Services\Front;

use InetStudio\RSS\Contracts\Services\Front\MindboxServiceContract;

/**
 * Class MindboxService.
 */
class MindboxService implements MindboxServiceContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services = [];

    public function __construct()
    {

    }

    public function getArticlesData()
    {
        $config = config('rss.mindbox_materials');

        $categories = app()->make('InetStudio\Categories\Contracts\Repositories\CategoriesRepositoryContract')
            ->getAllItems(true)
            ->addSelect(['parent_id', 'title'])
            ->get();

        $items = [];
        foreach ($config['sources'] as $source) {
            $items = array_merge($items, $this->getItems($source));
        }

        return [
            'categories' => $categories,
            'materials' => $items,
        ];
    }

    public function getQuizzesData()
    {

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
}
