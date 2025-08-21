<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Registra uma rota GET
     */
    public function get($path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    /**
     * Registra uma rota POST
     */
    public function post($path, $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    /**
     * Resolve a rota atual e executa o Controller
     */
    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            return $this->callAction($action);
        }

        // Caso a rota não exista
        http_response_code(404);
        echo "404 - Rota não encontrada ({$method} {$uri})";
        exit;
    }

    /**
     * Executa o Controller@method
     */
    private function callAction($action)
    {
        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_string($action)) {
            [$controller, $method] = explode('@', $action);

            $controllerFile = __DIR__ . '/../Controllers/' . $controller . '.php';
            if (!file_exists($controllerFile)) {
                throw new Exception("Controller {$controller} não encontrado.");
            }

            require_once $controllerFile;

            if (!class_exists($controller)) {
                throw new Exception("Classe {$controller} não existe.");
            }

            $instance = new $controller;

            if (!method_exists($instance, $method)) {
                throw new Exception("Método {$method} não existe no controller {$controller}.");
            }

            return $instance->$method();
        }

        throw new Exception("Ação inválida para a rota.");
    }
}
