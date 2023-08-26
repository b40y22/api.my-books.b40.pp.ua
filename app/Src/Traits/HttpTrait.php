<?php
declare(strict_types=1);

namespace App\Src\Traits;

trait HttpTrait
{
    /**
     * @param string $url
     * @return string
     */
    public function getDomain(string $url): string
    {
        if (strlen($url) > 0) {
            $urlComponents = parse_url($url);
            $hostName = str_replace('www', '', $urlComponents['host']);

            return implode('', array_map(function ($item) {
                return ucwords($item);
            }, explode('.', $hostName)));
        }

        return '';
    }
}
