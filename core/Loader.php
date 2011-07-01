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
}
