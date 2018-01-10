<?php

Route::group(['namespace' => 'InetStudio\RSS\Http\Controllers\Front'], function () {
    Route::group(['middleware' => 'web', 'prefix' => 'module/rss'], function () {
        Route::get('feed/{type}', 'RSSController@feed')->name('front.rss.feed');
    });
});
