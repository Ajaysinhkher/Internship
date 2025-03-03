<?php
namespace Core;
class Router
{
    // array will be filled using routes.php file
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            
        ];
        return $this;
    }

    public function get($uri, $controller)
    {
        // $this->add('GET', $uri, $controller);
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        // $this->add('POST', $uri, $controller);
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
       return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
       return $this->add('PUT', $uri, $controller);
    }

    
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {

            // echo "Checking Route: " . $route['uri'] . " (" . $route['method'] . ")<br>";
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }


    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
