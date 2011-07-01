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


namespace core;

require_once VENDOR_PATH . 'Smarty' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';

/**
 * Class loader
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Loader
{
    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Registration functions of autoloading
     * 
     * @return void
     */
    public static function register()
    {
        if (!spl_autoload_register(array(__CLASS__, 'load')))
            throw new \core\Exception('Could not register ' . __CLASS__ . '\'s autoload function!');
        if (!spl_autoload_register(array(__CLASS__, 'loadZendFramework')))
            throw new \core\Exception('Could not register Zend Framework\'s autoload function!');
        if (!spl_autoload_register('smartyAutoload'))
            throw new \core\Exception('Could not register Smarty\'s autoload function!');
    }

    /**
     * Autoloading
     * 
     * @param  string $className Class name
     * @return void
     */
    private static function load($className)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        try {
            if (!file_exists(ROOT_PATH . $path . '.php'))
                throw new \core\Exception('Class ' . $className . ' not found!');
        } catch (\core\Exception $e) {
            die($e->getMessage());
        }
        require_once ROOT_PATH . $path . '.php';
    }

    /**
     * Autoloading of Zend Framework's libraries
     * 
     * @param  string $className Class name
     * @return void
     */
    private static function loadZendFramework($className)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        try {
            if (!file_exists(VENDOR_PATH . $path . '.php'))
                throw new \core\Exception('Class ' . $className . ' not found!');
        } catch (\core\Exception $e) {
            die($e->getMessage());
        }
        require_once VENDOR_PATH . $path . '.php';
    }
}
