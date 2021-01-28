<?php


namespace App\Supports\Parsing;


use Illuminate\Support\Facades\Cache;

trait SpecNamesParsing
{
    /** @var string $cacheName */
    private string $cacheName = 'wow-spec-name:';

    /**
     * Parser zone
     * @param int $id
     * @return string
     */
    public function parserJsonSpec(int $id) : string
    {
        $spec = file_get_contents(
            realpath(__DIR__ . '/../../../public/constants/wow-spec-names.json')
        );

        foreach (json_decode($spec, true) as $specID => $specName) {
            if ($specID == $id) {
                Cache::put($this->cacheName . $id, $specName,4800);
                return $specID;
            }
        }
        return 'Неизвестно';
    }

    /**
     * @param int $id
     * @return string
     */
    public function getNameSpec(int $id): string
    {
        return Cache::has($this->cacheName . $id) ?
            Cache::get($this->cacheName . $id) : $this->parserJsonSpec($id);
    }
}
