<?php


namespace App\Supports;


trait ResponseJson
{
    /**
     * Give payload response
     * @param $type
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function givePayload($type, $data, $status = 200)
    {
        return response()->json([$type => $data], $status);
    }
}
