<?php

namespace InetStudio\RSS\Providers;

use Illuminate\Support\ServiceProvider;

class RSSServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/rss.php' => config_path('rss.php'),
        ], 'config');
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.rss');
    }
}
