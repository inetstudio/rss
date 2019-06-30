<?php

namespace InetStudio\RSS\Feeds\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\RSS\Feeds\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\RSS\Feeds\Contracts\Http\Controllers\Front\ItemsControllerContract;
use InetStudio\RSS\Feeds\Contracts\Http\Responses\Front\CustomFeedResponseContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
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
    public function feed(ItemsServiceContract $feedsService, Request $request, string $type = '')
    {
        $config = config('rss.'.$type);

        if (! $config) {
            return '';
        }

        $limit = ($request->filled('limit')) ? $request->get('limit') : ($config['feed']['limit'] ?? 0);
        $offset = ($request->filled('page')) ? ($request->get('page') - 1) * $limit : 0;
        $url = $request->fullUrl();

        $feed = $feedsService->feed($type, compact('config', 'limit', 'offset', 'url'));

        return $feed->render('rss');
    }

    /**
     * Выводим кастомный фид.
     *
     * @param  ItemsServiceContract  $feedsService
     * @param  string  $vendor
     * @param  string  $type
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function customFeed(ItemsServiceContract $feedsService, string $vendor, string $type): ?CustomFeedResponseContract
    {
        $config = config('rss.'.$vendor.'.'.$type);

        if (! $config) {
            return null;
        }

        $view = 'admin.module.rss.feeds::front.'.$vendor.'.'.$type;
        $data = $feedsService->getCustomData($vendor, $type);

        return $this->app->make(CustomFeedResponseContract::class, compact('view', 'data'));
    }
}
