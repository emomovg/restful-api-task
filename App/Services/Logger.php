<?php

namespace App\Services;

class Logger
{
    /**
     * @param  string  $message
     * @param  string|null  $channel
     * @return void
     */
    public static function info(string $message, ?string $channel = ''): void
    {
        $dir = 'logs/'.$channel;

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $logFileData = $dir.'/log-'.date('Y-m-d').'.log';
        file_put_contents($logFileData, $message."\n", FILE_APPEND);
    }
}