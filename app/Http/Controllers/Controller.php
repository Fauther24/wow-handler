<?php

namespace App\Http\Controllers;

use App\Supports\PingHandler;
use App\Supports\ResponseJson;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ResponseJson;

    /**
     * Base Connection on Characters
     * @var ConnectionInterface
     */
    protected ConnectionInterface $char;

    /**
     * Base Connection on Auth
     * @var ConnectionInterface
     */
    protected ConnectionInterface $auth;

    /**
     * Status connection
     * @var bool
     */
    protected bool $connection;

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
     * @return JsonResponse
     */
    public function pingHandler(Request $request, PingHandler $handler): JsonResponse
    {
        return $handler->ping();
    }

}
