<?php


namespace App\Supports;


use App\Http\Controllers\Controller;

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

    public function ping()
    {
        try {
            $connect = fsockopen($this->logon, $this->port, $errno, $errstr, 2);
            return !$connect ?
                $this->givePayload('error', [
                    'message' => 'No connection',
                    'response' => $errno . ': ' .$errstr
                ], 417) :
                $this->givePayload('success', 'Connected.');
        } catch (\Exception $exception) {
            return $this->givePayload('error', [
                'message' => 'No connection',
                'response' => $exception->getMessage()
            ], 417);
        }

    }

}
