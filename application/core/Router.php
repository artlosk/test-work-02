<?php

namespace application\core;

/**
 * Class Router
 * @package application\core
 */
class Router
{

    /**
     * @var array
     */
    protected $routes = [];
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var string
     */
    private $defaultController = 'default';
    /**
     * @var string
     */
    private $defaultAction = 'index';

    /**
     * Router constructor.
     * Construct. Load rules from file (config/rules)
     * and set keys-values in variable $routes
     */
    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        $routes = [];
        foreach ($arr as $key => $val) {
            foreach($val as $key1 => $val1) {
                $routes['section'] = $key;
                $routes['controller'] = $val1['controller'];
                $routes['action'] = $val1['action'];
                $this->add($key1, $routes);
            }
        }
    }

    /**
     * @param $route
     * @param $params
     * Method set route in variable $routes
     */
    public function add($route, $params)
    {
        //Escape forward slashes: '/' => '\/'
        $route = preg_replace('/\//', '\\/', $route);

        //Convert variables: f.e. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //Convert variables with custom regular expressions: f.e. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     * Method check routes
     * Load $params (id, page, sort).
     * If url ?id=1&sort=login, that $query explode and set manually
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        /**
         * Begin manually set $params
         */
        $args = [];
        $query = parse_url($url);
        if(!empty($query['query'])) {
            parse_str($query['query'], $args);
        }

        if(isset($query['path']) && $query['path'] != '') {
            $rt = explode('/', $query['path']);

            if(isset($rt[0])) {
                $this->params['section'] = $rt[0];
            }
            if(isset($rt[1])) {
                $this->params['controller'] = $rt[1];
            }
            if(isset($rt[2])) {
                $this->params['action']  = $rt[2];
            }

            if(isset($rt[0]) && !isset($rt[1])) {
                $this->params['controller'] = $this->defaultController;
            }
            if(isset($rt[1]) && !isset($rt[2])) {
                $this->params['action'] = $this->defaultAction;
            }

        }

        $this->params = array_merge($this->params, $args);
        /**
         * End manually set params
         */

        //if url = client/user/1/ - preg_match
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int)$match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
            }
        }
        if(!empty($this->params)) {
            return true;
        }

        return false;
    }

    /**
     * Method run router and call controller->action
     */
    public function run()
    {
        if ($this->match()) {
            $path = 'application\controllers\\' . $this->params['section'] . '\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                $action = 'action' . ucfirst($this->params['action']);
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $args = array_filter($this->params, function($value, $key) {
                        return $key != 'action' && $key != 'section' && $key != 'controller';
                    }, ARRAY_FILTER_USE_BOTH);

                    //$controller->$action($args['page'], $args['sort']);
                    call_user_func_array([$controller, $action], $args);
                    //$controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}