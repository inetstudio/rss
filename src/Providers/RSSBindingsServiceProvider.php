<?php

namespace InetStudio\RSS\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RSSBindingsServiceProvider.
 */
class RSSBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\RSS\Contracts\Http\Controllers\Front\MindboxControllerContract' => 'InetStudio\RSS\Http\Controllers\Front\MindboxController',
        'InetStudio\RSS\Contracts\Http\Controllers\Front\RSSControllerContract' => 'InetStudio\RSS\Http\Controllers\Front\RSSController',
        'InetStudio\RSS\Contracts\Http\Responses\MindboxResponseContract' => 'InetStudio\RSS\Http\Responses\MindboxResponse',
        'InetStudio\RSS\Contracts\Services\Front\MindboxServiceContract' => 'InetStudio\RSS\Services\Front\MindboxService',
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
