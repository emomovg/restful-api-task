<?php

namespace App\Controllers;

class Controller
{
    /**
     * @return array
     */
    protected function getBody(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * @return array
     */
    protected function getQueryStringData(): array
    {
        return $_GET;
    }

    /**
     * @param  int  $code
     * @param  string  $message
     * @param  array  $data
     * @return array
     */
    public static function response(int $code, string $message, array $data = []): array
    {
        $response = [
            'code' => $code,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return $response;
    }
}