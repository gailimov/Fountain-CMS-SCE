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
 * Config loader
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Config
{
    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Loads config file
     * 
     * @param  string $configFile Config file
     * @return array
     */
    public static function load($configFile)
    {
        $configPath = APP_PATH . 'config' . DIRECTORY_SEPARATOR . $configFile . '.php';
        try {
            if (!file_exists($configPath))
                throw new \core\Exception('File "' . $configFile . '.php" not found!');
        } catch (\core\Exception $e) {
            die($e->getMessage());
        }
        return require $configPath;
    }
}
