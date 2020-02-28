<?php


namespace App\Contract;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface RequestHandler
{
    public const STATUSES = [
        'OK'    => 0,
        'ERROR' => 'Handler error',
    ];

    /**
     * The processing of incoming data
     * @param Request $request
     * @return mixed
     */
    public function handler(Request $request);

    /**
     * Return data
     * @param $type
     * @param array $option
     * @return JsonResponse
     */
    public function make($type, array $option): object;

}
