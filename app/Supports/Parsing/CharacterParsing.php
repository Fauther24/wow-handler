<?php


namespace App\Supports;


trait CharacterParsing
{
    /**
     * name Fraction
     * @var array
     */
    protected array $faction = [
        'horde' => 2,
        'alliance' => 1
    ];

    /**
     * ID race Horde
     * @var array
     */
    protected array $raceHorde = [2, 5, 6, 8, 9, 10];

    /**
     * ID race Alliance
     * @var array
     */
    protected array $raceAlliance = [1, 3, 4, 7, 11, 22];

    /**
     * Get race Horde
     * @return array
     */
    public function getRaceHorde(): array
    {
        return $this->raceHorde;
    }

    /**
     * Get race Alliance
     * @return array
     */
    public function getRaceAlliance(): array
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
        return in_array($race, $this->raceHorde) ? $this->faction['horde'] : $this->faction['alliance'];
    }
}
