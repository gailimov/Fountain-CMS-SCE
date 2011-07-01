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
 * Registry
 * 
 * Implementation of Registry design pattern
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Registry
{
    /**
     * Singleton instance
     * 
     * @var \core\Registry
     */
    private static $_instance;

    /**
     * Array of registry
     * 
     * @var array
     */
    private $_registry = array();

    public function __construct()
    {}

    public function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @return \core\Registry
     */
    private static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Save a value by key into the registry
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public static function set($key, $value)
    {
        self::getInstance()->_registry[$key] = $value;
    }

    /**
     * Get a value by key from registry
     * 
     * @param  string $key Key
     * @return mixed or null
     */
    public static function get($key)
    {
        if (isset(self::getInstance()->_registry[$key]))
            return self::getInstance()->_registry[$key];
        return null;
    }
}
