<?php

namespace InetStudio\RSS\Http\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\RSS\Contracts\Http\Responses\CustomFeedResponseContract;

/**
 * Class CustomFeedResponse.
 */
class CustomFeedResponse implements CustomFeedResponseContract, Responsable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $view;

    /**
     * CustomFeedResponse constructor.
     *
     * @param string $view
     * @param array $data
     */
    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при запросе фида mindbox.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Throwable
     */
    public function toResponse($request)
    {
        return response(view($this->view, $this->data)->render(), 200, ['Content-Type' => 'text/xml; charset=utf-8']);
    }
}
