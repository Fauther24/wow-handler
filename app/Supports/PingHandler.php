<?php


namespace App\Supports;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PingHandler
{
    use ResponseJson;

    /**
     * @var string
     */
    protected $logon;
    /**
     * @var string
     */
    protected $port;

    public function __construct()
    {
        $this->logon = getenv('LOGON_DOMAIN');
        $this->port = getenv('DB_PORT');
    }

    /**
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        try {
            $connect = fsockopen($this->logon, $this->port, $errno, $errstr, 2);
            return $connect ? response()->json(['connected' => true]) : response()->json(['connected' => false]);
        } catch (\Exception $exception) {
            return response()->json(['connected' => false]);
        }

    }

}
