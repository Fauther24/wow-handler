<?php


namespace App\Supports\Parsing;

use Illuminate\Support\Facades\Cache;

trait ZoneParsing
{
    /** @var string $cacheName */
    private string $cacheName = 'wow-zone:';

    /**
     * Parser zone
     * @param int $id
     * @return string
     */
    public function parserJsonZone(int $id) : string
    {
        $zones = file_get_contents(
            realpath(__DIR__ . '/../../../public/constants/wow-zone-names.json')
        );

        foreach (json_decode($zones, true) as $zoneID => $zoneName) {
            if ($zoneID == $id) {
                Cache::put($this->cacheName . $id, $zoneName,4800);
                return $zoneName;
            }
        }
        return 'Неизвестно';
    }

    /**
     * @param int $id
     * @return string
     */
    public function getNameZone(int $id): string
    {
        return Cache::has($this->cacheName . $id) ?
            Cache::get($this->cacheName . $id) : $this->parserJsonZone($id);
    }

}
