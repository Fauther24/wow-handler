<?php


namespace App\Http\Resources\Statistics;


use Illuminate\Http\Resources\Json\JsonResource;

class OnlineWorldList extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'payload' => [
                'all' => $this->resource['all'],
                'horde' => $this->resource['horde'],
                'alliance' => $this->resource['alliance'],
                'status' => 'success'
            ]
        ];
    }
}
