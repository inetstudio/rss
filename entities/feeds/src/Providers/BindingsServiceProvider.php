<?php

namespace InetStudio\RSS\Feeds\Providers;

use Illuminate\Contracts\Container\Container;
use InetStudio\RSS\Feeds\Services\Front\Feed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvier;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvier implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        'InetStudio\RSS\Feeds\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\RSS\Feeds\Http\Controllers\Front\ItemsController',
        'InetStudio\RSS\Feeds\Contracts\Http\Responses\Front\CustomFeedResponseContract' => 'InetStudio\RSS\Feeds\Http\Responses\Front\CustomFeedResponse',
        'InetStudio\RSS\Feeds\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\RSS\Feeds\Services\Front\ItemsService',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('feed', function (Container $app) {
            $config = config('feed');

            return new Feed(
                $config,
                $app['Illuminate\Cache\Repository'],
                $app['config'],
                $app['files'],
                $app[ResponseFactory::class],
                $app['view']
            );
        });

        $this->app->alias('feed', Feed::class);
    }


    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(
            array_keys($this->bindings),
            [
                'feed',
                Feed::class,
            ]
        );
    }
}
