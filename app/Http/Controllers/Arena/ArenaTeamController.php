<?php


namespace App\Http\Controllers\Arena;


use App\Helpers\ExaminationHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArenaTeamController extends Controller implements ExaminationHandler
{
    /**
     * List type Arena
     * @var array
     */
    protected $types = [2,3,5];

    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        if (!$request->has('type')) {
            return response()->json([
                'status' => ExaminationHandler::STATUSES['ERROR'],
                'message' => 'Arena type is absent'
            ], 404);
        }

        return $this->make( $request->input('type'), [] );
    }

    /**
     * @inheritDoc
     */
    public function make($type, $option) : object
    {
        if( !in_array($type, $this->types) ) {
            return response()->json([
                'status' => ExaminationHandler::STATUSES['ERROR'],
                'message' => 'Arena type undefined'
            ], 404);
        }

        $data = DB::table('arena_team')
            ->select('name', 'captainGuid as captain', 'rating', 'seasonGames as games', 'seasonWins as wins')
            ->where('type', $type)
            ->orderByDesc('rating')
            ->get();

        return response()->json(['data' => $data]);
    }

}
