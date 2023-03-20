<?php
class Router
{
    private $root;
    private $endpoints = ['GET' => [], 'POST' => []];
    private $routers;

    function __construct(string $path = '')
    {
        $this->root = $path;
    }

    public function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $request_url = str_replace(strrev(preg_replace("/^(.*?)\/(.*?)$/", '\\2', strrev($_SERVER['PHP_SELF']))), '', $_SERVER['REDIRECT_URL']);
        foreach ($this->endpoints[$method] as $key => $endpoint) {
            if (str_replace('//', '/', $this->root . $key) === str_replace('//', '/', $request_url . '/')) {
                foreach ($endpoint[0] as $middleware) {
                    if (!$middleware([], [])) {
                        return;
                    }
                }
                $endpoint[1]();
                return;
            }
        }
        if (isset($this->routers)) {
            foreach ($this->routers as $route) {
                $route->handle();
            }
        }
    }

    public function setRoot($root)
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
    }
    public function get($path, $middlewares, $callback)
    {
        $this->endpoints['GET'][$path . '/'] = [$middlewares, $callback];
    }

    public function post($path, $middlewares, $callback)
    {
        $this->endpoints['POST'][$path . '/'] = [$middlewares, $callback];
    }
}
?>