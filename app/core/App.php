<?php

namespace core;

class App
{
    private $config = array();
    private $get = array();
    private $post = array();


    public function __construct($config)
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }

        if (isset($config['timezone'])) {
            date_default_timezone_set($config['timezone']);
        }

        if (isset($config['environment']) && $config['environment'] === 'develop') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);
        }

        define('TEMPLATES_DIR', str_replace('\\', '/', __DIR__ . '\..\templates\\'));
        define('CONFIG_DIR', str_replace('\\', '/', __DIR__ . '\..\config\\'));
    }


    public function get($url, $controller, $action)
    {
        $this->get[] = array(
            'url' => $url,
            'controller' => $controller,
            'action' => $action,
        );
    }


    public function post($url, $controller, $action)
    {
        $this->post[] = array(
            'url' => $url,
            'controller' => $controller,
            'action' => $action,
        );
    }


    private function findRoute($url, $routes)
    {
        foreach ($routes as $route) {
            $pattern = '/^' . preg_replace(
                    array('/\//', '/:digit/i', '/:any/i'),
                    array('\/', '(\d+)', '(\w+)'),
                    rtrim($route['url'], '/')) . '$/i';

            if (preg_match_all($pattern, rtrim($url, '/'), $matches)) {
                $params = array();
                for ($i = 1; $i < count($matches); $i++) {
                    $params[] = $matches[$i][0];
                }
                $route['params'] = $params;
                return $route;
            }
        }
    }


    private function executeRoute($route)
    {
        if (class_exists($route['controller'])) {
            $controller = new $route['controller'];
            if (method_exists($controller, $route['action'])) {
                $params = isset($route['params']) ? $route['params'] : array();
                call_user_func_array(array($controller, $route['action']), $params);
                return true;
            }
        }
    }


    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        $routes = $method === 'POST' ? $this->post : $this->get;
        $route = $this->findRoute($url, $routes);

        try {
            if (!isset($route) || !$this->executeRoute($route)) {
                \core\Redirect::error(null, 404);
            }
        } catch (\Exception $e) {
            \core\Redirect::error(null, 500);
        }
    }
}