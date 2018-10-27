<?php

Route::group([
    'namespace' => 'InetStudio\RSS\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
    'prefix' => 'module/rss',
], function () {
    Route::get('feed/{type}', 'RSSControllerContract@feed')->name('front.rss.feed');
    Route::get('{vendor}/{type}', 'RSSControllerContract@customFeed')->name('front.rss.custom');
});
