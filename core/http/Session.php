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


namespace core\http;

/**
 * HTTP session class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Session
{
    /**
     * Singleton instance
     * 
     * @var \core\http\Session
     */
    private static $_instance;

    /**
     * Check whether or not the session was started
     * 
     * @var bool
     */
    private $_started = false;

    /**
     * Check whether or not the session was destroyed
     * 
     * @var bool
     */
    private $_destroyed = false;

    /**
     * Namespace
     * 
     * @var string
     */
    private $_namespace;

    /**
     * Constructor
     * 
     * @param  string $namespace Namespace
     * @return void
     */
    private function __construct($namespace = null)
    {
        if ($namespace == null)
            $this->_namespace = 'default';
        else
            $this->_namespace = $namespace;
    }

    private function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @param  string $namespace Namespace
     * @return \core\http\Session
     */
    public static function getInstance($namespace = null)
    {
        if (!self::$_instance)
            self::$_instance = new self($namespace);
        return self::$_instance;
    }

    public function __set($property, $value)
    {
        $this->set($property, $value);
    }

    public function __get($property)
    {
        return $this->get($property);
    }

    public function __isset($property)
    {
        return $this->has($property);
    }

    public function __unset($property)
    {
        unset($_SESSION[$property]);
    }

    /**
     * Start the session
     * 
     * @return void
     */
    public function start()
    {
        // If session already started - exit
        if ($this->isStarted())
            return;
        session_start();
        $this->_started = true;
    }

    /**
     * Destroy session
     * 
     * @return void
     */
    public function destroy()
    {
        // If session already destroyed - exit
        if ($this->_destroyed)
            return;
        session_destroy();
        $this->_destroyed = true;
    }

    /**
     * Is session started?
     * 
     * @return bool
     */
    public function isStarted()
    {
        return $this->_started;
    }

    /**
     * Set namespace
     * 
     * @param  string $namespace Namespace
     * @return \core\http\Session
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = $namespace;
        return $this;
    }

    /**
     * Get namespace
     * 
     * @return string
     */
    public function getNamespace($namespace)
    {
        return $this->_namespace;
    }

    /**
     * Set session
     * 
     * @param  mixed $key Key
     * @param  mixed $value Value
     * @return \core\http\Session
     */
    public function set($key, $value)
    {
        $_SESSION[$this->_namespace][$key] = $value;
        return $this;
    }

    /**
     * $_SESSION
     * 
     * @return mixed or array if key does not exist
     */
    public function get($key = null)
    {
        if ($key == null)
            return $_SESSION;
        return $_SESSION[$this->_namespace][$key];
    }

    /**
     * Whether such a session key?
     * 
     * @return bool
     */
    public function has($key)
    {
        if (isset($_SESSION[$this->_namespace][$key]))
            return true;
        return false;
    }
}
