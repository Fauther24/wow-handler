<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

trait BasesConnection
{

    /**
     * Return connection Auth
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function getAuth()
    {
        return DB::connection('auth');
    }

    /**
     * Return connection Character
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function getChar()
    {
        return DB::connection('char');
    }

}
