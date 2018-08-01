<?php

namespace InetStudio\Articles\Http\Responses\Back\Articles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\RSS\Contracts\Responses\MindboxResponseContract;

/**
 * Class MindboxResponse.
 */
class MindboxResponse implements MindboxResponseContract, Responsable
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
     * MindboxResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
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
