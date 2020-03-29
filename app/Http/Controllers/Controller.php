<?php

namespace App\Http\Controllers;

use App\Supports\PingHandler;
use App\Supports\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ResponseJson;

    /**
     * Base Connection on Characters
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $char;

    /**
     * Base Connection on Auth
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $auth;

    /**
     * Status connection
     * @var bool
     */
    protected $connection;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->char = DB::connection('char');
        $this->auth = DB::connection('auth');
    }

    /**
     * Ping World of WarCraft connection
     * @param Request $request
     * @param PingHandler $handler
     * @return \Illuminate\Http\JsonResponse
     */
    public function pingHandler(Request $request, PingHandler $handler)
    {
        return $request->filled('key') && $request->input('key') === getenv('WOW_HANDLER_KEY') ?
            $handler->ping() :
            $this->givePayload('error', ['message' => 'Key does not exist.'], 417);
    }

}
