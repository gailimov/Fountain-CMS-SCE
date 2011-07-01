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

use core\Config;
use core\controller\Exception;

/**
 * Router
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Router
{
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

        // If there is no controller - set the default controller
        $config = Config::load('application');
        if (empty($controller)) $controller = $config['defaultController'];

        // If there is no action - set the default action
        if (empty($action)) $action = 'index';

        $controllerFile = ROOT_PATH . 'app' . DIRECTORY_SEPARATOR . 'controllers'
                                            . DIRECTORY_SEPARATOR . $controller . '.php';

        try {
            if (!file_exists($controllerFile))
                throw new Exception('Controller "' . $controller . '" not found!');
        } catch (Exception $e) {
            die($e->getMessage());
        }

        require_once $controllerFile;

        // If the class of controller is not loaded or there is no necessary method - 404
        // TODO: Write method for 404 errors
        if (!is_callable(array($controller, $action))) {
            header("HTTP/1.1 404 Not Found");
            die('404');
        }

        // Create instance of controller class
        $obj = new $controller();

        // Calling controller's action with parameters
        call_user_func_array(array($obj, $action), $params);
    }
}
