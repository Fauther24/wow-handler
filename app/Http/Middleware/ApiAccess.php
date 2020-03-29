<?php


namespace App\Http\Middleware;

use App\Supports\ResponseJson;
use Closure;
use Symfony\Component\HttpFoundation\IpUtils;

class ApiAccess
{
    use ResponseJson;
    /**
     * List of valid IPs.
     *
     * @var array
     */
    protected $ips = [
        '42.60.187.198',
        '188.102.29.159',
    ];

    /**
     * List of valid IP-ranges.
     *
     * @var array
     */
    protected $ipRanges = [
        '12.64.103.24',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($request->getClientIps() as $ip) {
            if (! $this->isValidIp($ip) && ! $this->isValidIpRange($ip)) {
                return $this->givePayload('error', ['message' => 'No access.']);
                // TODO: разработать оповещение о получение доступа
            }
        }

        return $next($request);
    }

    /**
     * Check if the given IP is valid.
     *
     * @param $ip
     * @return bool
     */
    protected function isValidIp($ip)
    {
        return in_array($ip, $this->ips);
    }

    /**
     * Check if the ip is in the given IP-range.
     *
     * @param $ip
     * @return bool
     */
    protected function isValidIpRange($ip)
    {
        return IpUtils::checkIp($ip, $this->ipRanges);
    }

}
