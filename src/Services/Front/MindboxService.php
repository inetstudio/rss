<?php

namespace InetStudio\RSS\Services\Front;

use InetStudio\RSS\Contracts\Services\Front\MindboxServiceContract;

/**
 * Class MindboxService.
 */
class MindboxService implements MindboxServiceContract
{
    /**
     * Отдаем данные для ленты статей.
     *
     * @return array
     */
    public function getArticlesData(): array
    {
        $config = config('rss.mindbox_materials');

        $categories = app()->make('InetStudio\Categories\Contracts\Repositories\CategoriesRepositoryContract')
            ->getAllItems(true)
            ->addSelect(['parent_id', 'title'])
            ->get();

        $items = collect([]);
        foreach ($config['sources'] as $source) {
            $items = $items->merge($this->getItems($source));
        }

        return [
            'categories' => $categories,
            'materials' => $items,
        ];
    }

    /**
     * Отдаем данные для ленты тестов.
     *
     * @return array
     */
    public function getQuizzesData(): array
    {
        $config = config('rss.mindbox_quizzes');

        $items = collect([]);
        foreach ($config['sources'] as $source) {
            $items = $items->merge($this->getItems($source));
        }

        return [
            'quizzes' => $items,
        ];
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
