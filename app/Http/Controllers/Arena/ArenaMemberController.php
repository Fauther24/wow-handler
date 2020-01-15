<?php


namespace App\Http\Controllers\Arena;



use App\Helpers\ExaminationHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArenaMemberController extends Controller implements ExaminationHandler
{

    /**
     * List type Arena
     * @var array
     */
    public $type = ['top', 'team'];

    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        if (!$request->has('type')) {
            return response()->json([
                'status' => ExaminationHandler::STATUSES['ERROR'],
                'message' => 'Type request is absent'
            ], 404);
        }

        $option = $request->has('arenaTeamId') ?
            ['arenaTeamId' => $request->input('arenaTeamId')] :
            [];

        return $this->make(
            $request->input('type'),
            $option
        );
    }

    /**
     * @inheritDoc
     */
    public function make($type, $option): object
    {
        return $type === 'top' ?
            $this->dataTopMember() :
            $this->dataTeamMember($option) ;
    }

    /**
     * Return top member
     * @return JsonResponse
     */
    public function dataTopMember() : object
    {
        $data = DB::table('arena_team_member as member')
            ->select(
                'member.*', 'team.name as team_name',
                'char.name as player_name', 'char.class as player_class', 'char.race as player_race'
            )
            ->join('arena_team as team', 'member.arenaTeamId', '=', 'team.ArenaTeamId')
            ->join('characters as char', 'member.guid', '=', 'char.guid')
            ->orderByDesc('member.personalRating')
            ->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Return data team member
     * @param array $option
     * @return JsonResponse
     */
    public function dataTeamMember($option) : object
    {
        $data = DB::table('arena_team as team')
            ->select('member.*', 'team.name as team_name',
                'char.name as player_name', 'char.class as player_class', 'char.race as player_race'
            )
            ->join('arena_team_member as member', 'team.arenaTeamId', '=', 'member.ArenaTeamId')
            ->join('characters as char', 'member.guid', '=', 'char.guid')
            ->where('member.arenaTeamId', '=', $option['arenaTeamId'])
            ->orderByDesc('member.personalRating')
            ->get();

        return response()->json(['data' => $data]);
    }
}
