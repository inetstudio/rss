<?php

return [

    'yandex' => [
        'feed' => [
            'title' => '',
            'description' => '',
            'language' => 'ru',
            'dateformat' => 'datetime',
            'view' => 'admin.module.rss::front.yandex',
            'type' => 'text/xml',
            'format' => 'rss',
        ],
        'sources' => [
            'articles' => '\InetStudio\Articles\Services\Front\ArticlesService@getFeedItems',
            'ingredients' => '\InetStudio\Ingredients\Services\Front\IngredientsService@getFeedItems',
        ],
    ],

];
