<?php

namespace InetStudio\RSS\Feeds\Contracts\Services\Front;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract
{
    /**
     * Формируем фид.
     *
     * @param  string  $type
     * @param  array  $params
     *
     * @return mixed
     */
    public function feed(string $type, array $params);

    /**
     * Данные для кастомного фида.
     *
     * @param  string  $vendor
     * @param  string  $type
     *
     * @return array
     */
    public function getCustomData(string $vendor, string $type = ''): array;
}
