<?php

namespace InetStudio\RSS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class RSSBindingsServiceProvider.
 */
class RSSBindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\RSS\Contracts\Http\Controllers\Front\RSSControllerContract' => 'InetStudio\RSS\Http\Controllers\Front\RSSController',
        'InetStudio\RSS\Contracts\Http\Responses\CustomFeedResponseContract' => 'InetStudio\RSS\Http\Responses\CustomFeedResponse',
        'InetStudio\RSS\Contracts\Services\Front\RSSServiceContract' => 'InetStudio\RSS\Services\Front\RSSService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
