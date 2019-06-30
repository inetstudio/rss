<?php

namespace InetStudio\RSS\Feeds\Http\Responses\Front;

use Throwable;
use Illuminate\Http\Request;
use InetStudio\RSS\Feeds\Contracts\Http\Responses\Front\CustomFeedResponseContract;

/**
 * Class CustomFeedResponse.
 */
class CustomFeedResponse implements CustomFeedResponseContract
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $view;

    /**
     * CustomFeedResponse constructor.
     *
     * @param  string  $view
     * @param  array  $data
     */
    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при запросе кастомного фида.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function toResponse($request)
    {
        return response(
            view($this->view, $this->data)->render(),
            200,
            [
                'Content-Type' => 'text/xml; charset=utf-8',
            ]
        );
    }
}
