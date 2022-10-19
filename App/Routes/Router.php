<?php

namespace App\Routes;

use App\Controllers\Controller;

class Router
{
    /**
     * @var array
     */
    private array $handlers;

    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private const METHOD_PUT = 'PUT';
    private const METHOD_DELETE = 'DELETE';

    /**
     * @param  string  $path
     * @param  string  $handler
     * @return $this
     */
    public function get(string $path, string $handler): self
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);

        return $this;
    }

    /**
     * @param  string  $path
     * @param  string  $handler
     * @return Router
     */
    public function post(string $path, string $handler): self
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);

        return $this;
    }

    /**
     * @param  string  $path
     * @param  string  $handler
     * @return Router
     */
    public function put(string $path, string $handler): self
    {
        $this->addHandler(self::METHOD_PUT, $path, $handler);

        return $this;
    }

    /**
     * @param  string  $path
     * @param  string  $handler
     * @return Router
     */
    public function delete(string $path, string $handler): self
    {
        $this->addHandler(self::METHOD_DELETE, $path, $handler);

        return $this;
    }

    /**
     * @param  string  $middleware
     * @return void
     */
    public function middleware(string $middleware): void
    {
        $key = array_key_last($this->handlers);
        $this->handlers[$key]['middleware'] = $middleware;
    }

    /**
     * @param  string  $method
     * @param  string  $path
     * @param $handler
     * @return void
     */
    private function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method.$path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    /**
     * @return array
     */
    public function run(): array
    {
        $requestPath = parse_url($_SERVER['REQUEST_URI'])['path'];
        $callback = null;
        $middleware = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $handler['method'] === $_SERVER['REQUEST_METHOD']) {
                $callback = $handler['handler'];

                if (array_key_exists('middleware', $handler)) {
                    $middleware = $handler['middleware'];
                }
            }
        }

        if (is_string($callback)) {
            $parts = explode('::', $callback);
            if (is_array($parts)) {
                $className = array_shift($parts);
                $handler = new $className;

                $method = array_shift($parts);
                $callback = [$handler, $method];
            }
        }

        if (!$callback) {
            return Controller::response(404, 'Routes does not exists');
        }

        if ($middleware) {
           return $middleware::handle($callback);
        }

        return call_user_func($callback);
    }
}