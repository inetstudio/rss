<?php

namespace InetStudio\RSS\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\RSS\Contracts\Http\Controllers\Front\RSSControllerContract;

/**
 * Class RSSController.
 */
class RSSController extends Controller implements RSSControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services = [];

    /**
     * RSSController constructor.
     */
    public function __construct()
    {
        $this->services['rss'] = app()->make('InetStudio\RSS\Contracts\Services\Front\RSSServiceContract');
    }

    /**
     * Выводим фид.
     *
     * @param Request $request
     * @param string $type
     *
     * @return mixed
     */
    public function feed(Request $request, string $type = '')
    {
        $config = config('rss.'.$type);

        if (! $config) {
            return '';
        }

        $limit = ($request->filled('limit')) ? $request->get('limit') : ((isset($config['feed']['limit'])) ? $config['feed']['limit'] : 0);
        $offset = ($request->filled('page')) ? ($request->get('page') - 1)*$limit : 0;
        $url = $request->fullUrl();

        $feed = $this->services['rss']->feed($type, compact('config', 'limit', 'offset', 'url'));

        return $feed->render('rss');
    }
}
