<?php

namespace InetStudio\RSS\Feeds\Contracts\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\RSS\Feeds\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\RSS\Feeds\Contracts\Http\Responses\Front\CustomFeedResponseContract;

/**
 * Interface ItemsControllerContract.
 */
interface ItemsControllerContract
{
    /**
     * Выводим фид.
     *
     * @param  ItemsServiceContract  $feedsService
     * @param  Request  $request
     * @param  string  $type
     *
     * @return mixed
     */
    public function feed(ItemsServiceContract $feedsService, Request $request, string $type = '');

    /**
     * Выводим кастомный фид.
     *
     * @param  ItemsServiceContract  $feedsService
     * @param  string  $vendor
     * @param  string  $type
     *
     * @return mixed
     */
    public function customFeed(ItemsServiceContract $feedsService, string $vendor, string $type): ?CustomFeedResponseContract;
}
