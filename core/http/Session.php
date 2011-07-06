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

    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @return \core\http\Session
     */
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function __isset($property)
    {
        $this->has($property);
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
     * $_SESSION
     * 
     * @return mixed or array if key does not exist
     */
    public function get($key = null)
    {
        if ($key == null)
            return $_SESSION;
        return $_SESSION[$key];
    }

    /**
     * Whether such a session key?
     * 
     * @return bool
     */
    public function has($key)
    {
        if (isset($_SESSION[$key]))
            return true;
        return false;
    }
}
