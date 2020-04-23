<?php

namespace InetStudio\RSS\Feeds\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public array $bindings = [
        'InetStudio\RSS\Feeds\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\RSS\Feeds\Http\Controllers\Front\ItemsController',
        'InetStudio\RSS\Feeds\Contracts\Http\Responses\Front\CustomFeedResponseContract' => 'InetStudio\RSS\Feeds\Http\Responses\Front\CustomFeedResponse',
        'InetStudio\RSS\Feeds\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\RSS\Feeds\Services\Front\ItemsService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
