<?php

namespace App\Http\Controllers;

use App\Helpers\BasesConnection;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use BasesConnection;

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
     * Controller constructor.
     */
    public function __construct()
    {
        $this->char = $this->getChar();
        $this->auth = $this->getAuth();
    }

}
