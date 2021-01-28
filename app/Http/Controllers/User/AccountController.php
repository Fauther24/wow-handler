<?php


namespace App\Http\Controllers\User;


use App\Contract\RequestHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use phpDocumentor\Reflection\Types\Object_;

class AccountController extends Controller implements RequestHandler
{
    private string $email;

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

        if(! $request->has('info') ) {
            return response()->json([
                'status' => RequestHandler::STATUSES['ERROR'],
                'message' => 'Info is not exist.'
            ], 404);
        }

        $this->email = $request->get('user_email');

        return $this->make(
            $request->get('info'),
            []
        );
    }

    /**
     * @inheritDoc
     */
    public function make($info, array $option): object
    {
        switch ($info) {
            case 'bonuses':
                return $this->getBonuses(); break;
            default:
                return $this->givePayload('error', ['messages' => 'Info not found.']);
        }
    }

    /**
     * Return count bonuses User on email
     * @return JsonResponse
     */
    public function getBonuses()
    {
        $data = Cache::remember('user-bonuses-handler:' . $this->email, 300, function () {
            return $this->auth->table('account')
                ->select('bonuses')
                ->where('email', $this->email)
                ->get();
        });
        return $this->givePayload('payload', $data);
    }


    /**
     * Return guid for user
     * @param $email string
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserUid(string $email)
    {
        /** @var Object_ $uid */
        $uid = $this->auth->table('account')
            ->select('id')
            ->where('email', $email)
            ->first();

        return $uid->id;
    }
}
