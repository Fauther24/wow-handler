<?php


namespace App\Http\Controllers\Arena;


use App\Contract\RequestHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\Arena\ArenaMemberList;
use App\Supports\ResponseJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArenaTopPlayerController extends Controller implements RequestHandler
{
    use ResponseJson;

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
                'status' => RequestHandler::STATUSES['ERROR'],
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
    public function make($type, $option = []): object
    {
        return $this->dataTopPlayer($type);
    }

    /**
     * Return top member
     * @param int $type
     * @return JsonResponse
     */
    public function dataTopPlayer(int $type) : object
    {
        $data = $this->char->table('arena_team_member as member')
            ->select(
                'member.*', 'team.name as team_name', 'team.type as team_type',
                'char.name as player_name', 'char.class as player_class', 'char.race as player_race'
            )
            ->join('arena_team as team', 'member.arenaTeamId', '=', 'team.ArenaTeamId')
            ->join('characters as char', 'member.guid', '=', 'char.guid')
            ->where('team.type', $type)
            ->where('member.personalRating', '>', '500')
            ->orderByDesc('member.personalRating')
            ->get();
        return new ArenaMemberList($data);
    }
}
