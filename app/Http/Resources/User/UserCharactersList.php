<?php


namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;

class UserCharactersList extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => UserCharactersItem::collection($this->resource)
        ];
    }
}
