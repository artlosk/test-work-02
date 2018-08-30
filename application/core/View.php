<?php

namespace application\core;

/**
 * Class View
 * @package application\core
 */
class View
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var array
     */
    public $route;
    /**
     * @var string
     */
    public $layout = 'frontend';

    /**
     * View constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['section'] . '/' . $route['controller'] . '/' . $route['action'];
    }

    /**
     * @param string $path
     * @param array $vars
     * Method render template
     */
    public function render($path = '', $vars = [])
    {
        if ($path == '') $path = $this->path;

        extract($vars);
        $template = 'application/views/' . $this->route['section'] . '/' . $this->route['controller'] . '/' . $path . '.php';
        if (file_exists($template)) {
            ob_start();
            require $template;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        }
    }

    /**
     * @param $url
     * Method redirect to
     */
    public static function redirect($url)
    {
        header('location: /' . $url);
        exit;
    }

    /**
     * @param $code
     * Method render error page by error code
     */
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'application/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    /**
     * @param $status
     * @param $message
     * @param array $fields
     * Method handler Php and Js for notification user success or error (highlight fields)
     */
    public function message($status, $message, $fields = [])
    {
        exit(json_encode(['status' => $status, 'message' => $message, 'fields' => $fields]));
    }

    /**
     * @param $url
     * Method redirect via JS
     * Send variable $url
     */
    public function redirectJs($url)
    {
        exit(json_encode(['url' => $url]));
    }
}