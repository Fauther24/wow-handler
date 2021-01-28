<?php


namespace App\Http\Resources\Arena;


use Illuminate\Http\Resources\Json\JsonResource;

class ArenaMemberList extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => ArenaPlayerItem::collection($this->resource)
        ];
    }
}
