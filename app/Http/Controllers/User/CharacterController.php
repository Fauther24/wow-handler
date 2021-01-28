<?php


namespace App\Http\Controllers\User;


use App\Contract\RequestHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCharactersList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CharacterController extends Controller implements RequestHandler
{
    private string $uid;

    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        if (! $request->has('uid') ) {
            return response()->json([
                'status' => RequestHandler::STATUSES['ERROR'],
                'message' => 'User uid is not exist.'
            ], 404);
        }

        $this->uid = $request->get('uid');
        return $this->make([], []);
    }

    /**
     * @inheritDoc
     */
    public function make($value, array $option): object
    {
        $data = Cache::remember('user-char:' . $this->uid, 900, function () {
            return $this->char->table('characters')
                ->select('name', 'race', 'class', 'gender', 'level', 'online', 'zone')
                ->where('account', $this->uid)
                ->get();
        });
        return new UserCharactersList($data);
    }
}
