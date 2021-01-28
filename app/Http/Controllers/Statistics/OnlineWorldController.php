<?php


namespace App\Http\Controllers\Statistics;


use App\Contract\RequestHandler;
use App\Http\Resources\Statistics\OnlineWorldList;
use App\Supports\Parsing\CharacterParsing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class OnlineWorldController extends Controller implements RequestHandler
{
    use CharacterParsing;
    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        return $this->make([], []);
    }

    /**
     * @inheritDoc
     */
    public function make($type, array $option): object
    {
        $all = Cache::remember('online-world', 60, function () {
            return $this->char->table('characters')
                ->select('race')
                ->where('online', 1)
                ->get();
        });

        $data = [
            'all' => count($all),
            'horde' => [],
            'alliance' => []
        ];

        /** @var  Collection $item */
        foreach ($all as $item) {
            if ( array_key_exists($item->race, $this->getRaceHorde()) ) {
                array_push($data['horde'], $item);
            } else {
                array_push($data['alliance'], $item);
            }
        }

        $data['horde'] = round( (count($data['horde']) / $data['all']) * 100 );
        $data['alliance'] = round( (count($data['alliance']) / $data['all']) * 100 );

        return new OnlineWorldList($data);
    }
}
