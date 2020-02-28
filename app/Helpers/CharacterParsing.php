<?php


namespace App\Helpers;


trait CharacterParsing
{
    /**
     * name Fraction
     * @var array
     */
    protected $faction = [
        1 => ['name' => 'Орда'],
        2 => ['name' => 'Альянс'],
    ];

    /**
     * name race Horde
     * @var array
     */
    protected $raceHorde = [
        2 => ['name' => 'Орк'],
        5 => ['name' => 'Нежить'],
        6 => ['name' => 'Таурен'],
        8 => ['name' => 'Тролль'],
        9 => ['name' => 'Гоблин'],
        10 => ['name' => 'Эльф крови']
    ];

    /**
     * Name race Alliance
     * @var array
     */
    protected $raceAlliance = [
        1 => ['name' => 'Человек'],
        3 => ['name' => 'Дворф'],
        4 => ['name' => 'Ночной эльф'],
        7 => ['name' => 'Гном'],
        11 => ['name' => 'Дреней'],
        22 => ['name' => 'Ворген']
    ];


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
