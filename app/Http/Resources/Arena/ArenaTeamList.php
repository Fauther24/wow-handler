<?php


namespace App\Http\Resources\Arena;


use Illuminate\Http\Resources\Json\Resource;

class ArenaTeamList extends Resource
{
    public function toArray($request)
    {
        return $this->resource;
    }
}
