<?php
class Router
{
    private $root;
    private $endpoints = ['GET' => [], 'POST' => [], 'UPDATE' => [], 'DELETE' => []];
    private $routers;

    function __construct(string $path = '/')
    {
        $this->root = $path;
    }

    public function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $request_url = $_SERVER['REDIRECT_URL'];
        foreach ($this->endpoints[$method] as $key => $endpoint) {
            preg_match_all('#:([A-Za-z0-9_-]+)#', $this->root . $key, $paramsKey);
            if (!empty($paramsKey[1])) {
                $str = $this->root . $key;
                $reg = preg_replace("#:[A-Za-z0-9_-]*#", '([A-Za-z0-9_\-\.]*)', $str);
                $reg = preg_replace('#//(/*)#', '/', $reg);
                preg_match("#$reg#", $request_url . '/', $paramsValue);
                if (!empty($paramsValue[0]) && $paramsValue[0] === preg_replace('#//(/*)#', '/', $request_url . '/')) {
                    foreach ($endpoint[0] as $middleware) {
                        if (!$middleware([], [])) {
                            return;
                        }
                    }
                    unset($paramsValue[0]);
                    $endpoint[1](array_combine($paramsKey[1], $paramsValue));
                    return;
                }
            } else {
                if (preg_replace('#//(/*)#', '/', $this->root . $key) === preg_replace('#//(/*)#', '/', $request_url . '/')) {
                    foreach ($endpoint[0] as $middleware) {
                        if (!$middleware([], [])) {
                            return;
                        }
                    }
                    $endpoint[1]();
                    return;
                }
            }
        }
        if (isset($this->routers)) {
            foreach ($this->routers as $route) {
                $route->handle();
            }
        }
    }

    private function setRoot($root)
    {
        $this->root = $root . $this->root;
    }
    public function use (Router $router)
    {
        $router->setRoot($this->root);
        $this->routers[] = $router;
    }

    public function any($path, $middlewares, $callback)
    {
        $this->endpoints['GET'][$path . '/'] = [$middlewares, $callback];
        $this->endpoints['POST'][$path . '/'] = [$middlewares, $callback];
        $this->endpoints['DELETE'][$path . '/'] = [$middlewares, $callback];
        $this->endpoints['UPDATE'][$path . '/'] = [$middlewares, $callback];
    }
    public function get($path, $middlewares, $callback)
    {
        $this->endpoints['GET'][$path . '/'] = [$middlewares, $callback];
    }

    public function post($path, $middlewares, $callback)
    {
        $this->endpoints['POST'][$path . '/'] = [$middlewares, $callback];
    }
    public function update($path, $middlewares, $callback)
    {
        $this->endpoints['UPDATE'][$path . '/'] = [$middlewares, $callback];
    }

    public function delete($path, $middlewares, $callback)
    {
        $this->endpoints['DELETE'][$path . '/'] = [$middlewares, $callback];
    }
}
?>