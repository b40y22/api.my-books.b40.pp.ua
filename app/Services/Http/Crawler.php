<?php

namespace App\Services\Http;

use Crwlr\Crawler\HttpCrawler;
use Crwlr\Crawler\UserAgents\UserAgent;
use Crwlr\Crawler\UserAgents\UserAgentInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class Crawler extends HttpCrawler
{
    /**
     * @return LoggerInterface
     */
    protected function logger(): LoggerInterface
    {
        return new Logger('MyLogger');
    }

    /**
     * @return UserAgentInterface
     */
    protected function userAgent(): UserAgentInterface
    {
        return new UserAgent(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:99.0) Gecko/20100101 Firefox/99.0'
        );
    }
}
