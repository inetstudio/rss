<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\RSS\Feeds\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
        'prefix' => 'module/rss',
    ],
    function () {
        Route::get('feed/{type}', 'ItemsControllerContract@feed')->name('front.rss.feed');
        Route::get('{vendor}/{type}', 'ItemsControllerContract@customFeed')->name('front.rss.custom');
    }
);
