<?php


namespace App\Http\Resources\Arena;


use App\Supports\CharacterParsing;
use Illuminate\Http\Resources\Json\JsonResource;

class ArenaPlayerItem extends JsonResource
{
    use CharacterParsing;

    public function toArray($request)
    {
        return [
            'guid' => $this->resource->guid,
            'name' => $this->resource->player_name,
            'rating' => $this->resource->personalRating,
            'class' => $this->resource->player_class,
            'race' => $this->resource->player_race,
            'fraction' => $this->fetchFractionOfRace($this->resource->player_race),
            'win' => $this->resource->seasonWins,
            'lose' => $this->resource->seasonGames - $this->resource->seasonWins
        ];
    }
}
