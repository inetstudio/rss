<?php

Route::group([
    'namespace' => 'InetStudio\RSS\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
    'prefix' => 'module/rss',
], function () {
    Route::get('feed/{type}', 'RSSControllerContract@feed')->name('front.rss.feed');
    Route::get('mindbox/articles', 'MindboxControllerContract@getArticlesFeed')->name('front.rss.mindbox.articles');
    Route::get('mindbox/quizzes', 'MindboxControllerContract@getQuizzesFeed')->name('front.rss.mindbox.quizzes');
});
