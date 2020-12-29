<?php


namespace App\Http\Controllers\Arena;


use App\Contract\RequestHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\Arena\ArenaTeamList;
use Illuminate\Http\Request;

class ArenaTeamController extends Controller implements RequestHandler
{
    /**
     * List type Arena
     * @var array
     */
    protected array $types = [2, 3, 5];

    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        if (! $request->has('type')) {
            return response()->json([
                'status' => RequestHandler::STATUSES['ERROR'],
                'message' => 'Arena type is absent'
            ], 404);
        }

        if (! in_array($request->input('type'), $this->types) ) {
            return response()->json([
                'status' => RequestHandler::STATUSES['ERROR'],
                'message' => 'Arena type undefined'
            ], 404);
        }

        return $this->make(
            $request->input('type'),
            []
        );
    }

    /**
     * @inheritDoc
     */
    public function make($type, $option) : object
    {
        $data = $this->char->table('arena_team')
            ->select('name', 'captainGuid as captain', 'rating', 'seasonGames as games', 'seasonWins as wins')
            ->where('type', $type)
            ->orderByDesc('rating')
            ->get();

        return new ArenaTeamList($data);
    }

}
