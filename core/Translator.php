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
 * Translator
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Translator
{
    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Load language file
     * 
     * @param  string $file File
     * @param  string $lang Language
     * @return array
     */
    public static function load($file, $lang)
    {
        $path = APP_PATH . 'i18n' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . $file . '.php';
        try {
            if (!file_exists($path))
                throw new \core\Exception('File "' . $lang . '/' . $file . '.php" not found!');
        } catch (\core\Exception $e) {
            die($e->getMessage());
        }
        return require $path;
    }
}
