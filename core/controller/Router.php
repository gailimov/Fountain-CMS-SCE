<?php

/**
 * Fountain CMS Site Card Edition
 * 
 * Lightweight content management system for site cards and minisites
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) Kanat Gailimov (http://gailimov.info) 2011
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */


namespace core\controller;

use core\Config,
    core\Registry,
    core\controller\Exception,
    core\http\NotFoundException;

/**
 * Router
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Router
{
    /**
     * Routes
     * 
     * @var array
     */
    private $_routes;

    public function __construct()
    {
        $this->_routes = Config::load('routes');
    }

    /**
     * Get URI
     * 
     * @return array
     */
    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI']))  return $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['PATH_INFO']))    return $_SERVER['PATH_INFO'];
        if (!empty($_SERVER['QUERY_STRING'])) return $_SERVER['QUERY_STRING'];
    }

    /**
     * Parsing of the URI and getting segments
     * 
     * @return array
     */
    private function getUriSegments()
    {
        $uri = $this->getUri();

        // Parsing of the URI
        $segments = preg_replace("/^(.*?)index\.php$/is", "$1", $_SERVER['SCRIPT_NAME']);
        $segments = preg_replace("/^".preg_quote($segments, "/")."/is", "", urldecode($uri));
        $segments = preg_replace("/(\/?)(\?.*)?$/is", "", $segments);
        // Cut out unnecessary characters
        $segments = preg_replace("/[^0-9A-Za-zА-Я-а-я._\\-\\/]/is", "", $segments);
        // Split the URI to slashes
        $segments = explode("/", $segments);
        // Remove the suffix
        if (preg_match("/^index\.(?:html|php)$/is", $uri[count($segments) - 1]))
            unset($segments[count($segments) - 1]);

        return $segments;
    }

    /**
     * Dispatching of the URI
     * 
     * @return void
     */
    public function dispatch()
    {
        $segments = $this->getUriSegments();

        $params = array();

        $uri = implode('/', $segments);

        foreach ($this->_routes as $pattern => $route) {
            // if routes matched
            if (preg_match($pattern, $uri)) {
                $internalRoute = preg_replace($pattern, $route, $uri);
                $internalRoute = explode('/', $internalRoute);
                if ($internalRoute[0] == 'index.php') {
                    if (isset($internalRoute[1]) && !empty($internalRoute[1]))
                        $controller = ucfirst($internalRoute[1] . 'Controller');
                    if (isset($internalRoute[2]) && !empty($internalRoute[2]))
                        $action = $internalRoute[2];
                    if (count($internalRoute) > 3)
                        $params = array_slice($internalRoute, 3);
                } else {
                    if (isset($internalRoute[0]) && !empty($internalRoute[0]))
                        $controller = ucfirst($internalRoute[0] . 'Controller');
                    if (isset($internalRoute[1]) && !empty($internalRoute[1]))
                        $action = $internalRoute[1];
                    if (count($internalRoute) > 2)
                        $params = array_slice($internalRoute, 2);
                }
                $flag = true;
            }
        }

        // If routes not matched or routes not exists - run default routing
        if (!isset($flag)) {
            if ($segments[0] == 'index.php') {
                if (isset($segments[1]) && !empty($segments[1]))
                    $controller = ucfirst($segments[1] . 'Controller');
                if (isset($segments[2]) && !empty($segments[2]))
                    $action = $segments[2];
                if (count($segments) > 3)
                    $params = array_slice($segments, 3);
            } else {
                if (isset($segments[0]) && !empty($segments[0]))
                    $controller = ucfirst($segments[0] . 'Controller');
                if (isset($segments[1]) && !empty($segments[1]))
                    $action = $segments[1];
                if (count($segments) > 2)
                    $params = array_slice($segments, 2);
            }
        }

        // If there is no controller - set the default controller
        $config = Config::load('application');
        if (empty($controller)) $controller = $config['defaultController'];

        // If there is no action - set the default action
        if (empty($action)) $action = 'index';

        $controllerFile = APP_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controller . '.php';

        if (!file_exists($controllerFile))
            throw new Exception('Controller "' . $controller . '" not found!');

        require_once $controllerFile;

        // If the class of controller is not loaded or there is no necessary method - 404
        if (!is_callable(array($controller, $action)))
            throw new NotFoundException();

        // Setting array of URI options
        $options = array('controller' => str_replace('Controller', '', $controller),
                         'action'     => $action,
                         'params'     => $params);

        // Setting options into the registry
        Registry::set('options', $options);

        // Create instance of controller class
        $obj = new $controller();

        // Calling controller's action with parameters
        call_user_func_array(array($obj, $action), $params);
    }
}
