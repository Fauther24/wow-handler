<?php


namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Supports\Parsing\CharacterParsing;
use App\Supports\Parsing\ZoneParsing;

class UserCharactersItem extends JsonResource
{
    use CharacterParsing, ZoneParsing;

    public function toArray($request): array
    {
        return [
            'name'      => $this->resource->name,
            'fraction'  => $this->fetchFractionOfRace($this->resource->race),
            'race'      => $this->resource->race,
            'class'     => $this->resource->class,
            'gender'    => $this->resource->gender,
            'level'     => $this->resource->level,
            'is_online' => $this->resource->online,
            'zone'      => $this->getNameZone($this->resource->zone),
            'zone_id'   => $this->resource->zone
        ];
    }
}
