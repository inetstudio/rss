<?php

namespace InetStudio\RSS\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use InetStudio\RSS\Contracts\Responses\MindboxResponseContract;
use InetStudio\RSS\Contracts\Http\Controllers\Front\MindboxControllerContract;

/**
 * Class MindboxController.
 */
class MindboxController extends Controller implements MindboxControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services = [];

    /**
     * MindboxController constructor.
     */
    public function __construct()
    {
        $this->services['mindbox'] = app()->make('InetStudio\RSS\Contracts\Services\Front\MindboxServiceContract');
    }

    /**
     * Возвращаем фид статей.
     *
     * @return MindboxResponseContract
     */
    public function getArticlesFeed(): MindboxResponseContract
    {
        $view = 'admin.module.rss::front.mindbox.articles';
        $data = $this->services['mindbox']->getArticlesData();

        return app()->makeWith(MindboxResponseContract::class, compact('view', 'data'));
    }

    /**
     * Возвращаем фид тестов.
     *
     * @return MindboxResponseContract
     */
    public function getQuizzesFeed(): MindboxResponseContract
    {
        $view = 'admin.module.rss::front.mindbox.quizzes';
        $data = $this->services['mindbox']->getQuizzesData();

        return app()->makeWith(MindboxResponseContract::class, compact('view', 'data'));
    }
}
