<?php


namespace App\Supports;


trait CharacterParsing
{
    /**
     * name Fraction
     * @var array
     */
    protected $faction = [1, 2];

    /**
     * ID race Horde
     * @var array
     */
    protected $raceHorde = [2, 5, 6, 8, 9, 10];

    /**
     * ID race Alliance
     * @var array
     */
    protected $raceAlliance = [1, 3, 4, 7, 11, 22];


    /**
     * Get race Horde
     * @return array
     */
    public function getRaceHorde()
    {
        return $this->raceHorde;
    }

    /**
     * Get race Alliance
     * @return array
     */
    public function getRaceAlliance()
    {
        return $this->raceAlliance;
    }

    /**
     * Fetch Faction parsing of Race
     * @param $race
     * @return false|int|string
     */
    public function fetchFractionOfRace($race)
    {
        $races = array_merge($this->raceAlliance, $this->raceHorde);
        return array_search($race, $races);
    }
}
