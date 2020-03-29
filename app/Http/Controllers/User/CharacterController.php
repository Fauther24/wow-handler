<?php


namespace App\Http\Controllers\User;


use App\Contract\RequestHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CharacterController extends Controller implements RequestHandler
{
    private string $email;
    private string $uid;

    /**
     * @inheritDoc
     */
    public function handler(Request $request)
    {
        if (! $request->has('user_email') ) {
            return response()->json([
                'status' => RequestHandler::STATUSES['ERROR'],
                'message' => 'User email is not exist.'
            ], 404);
        }

        $this->email = $request->get('user_email');
        $this->uid = (new AccountController())->getUserUid($this->email);
        return $this->make([], []);
    }

    /**
     * @inheritDoc
     */
    public function make($value, array $option): object
    {
        return $this->givePayload('payload', $this->getCharacters());
    }

    /**
     * Get characters on guid
     * @return mixed
     */
    public function getCharacters()
    {
        return Cache::remember('user-char:' . $this->email, 900, function () {
            return $this->char->table('characters')
                ->select('name', 'race', 'race', 'class', 'gender', 'level', 'online')
                ->where('account', $this->uid)
                ->get();
        });
    }

}
