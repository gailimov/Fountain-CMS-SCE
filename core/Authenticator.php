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
 * Authentication
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Authenticator
{
    /**
     * Singleton instance
     * 
     * @var \core\Authenticator
     */
    private static $_instance;

    /**
     * Identifier
     * 
     * @var string
     */
    private $_identifier;

    /**
     * Password
     * 
     * @var string
     */
    private $_password;

    /**
     * Input identifier
     * 
     * @var string
     */
    private $_inputIdentifier;

    /**
     * Input password
     * 
     * @var string
     */
    private $_inputPassword;

    /**
     * Error
     * 
     * @var string
     */
    private $_error;

    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @return \core\Authenticator
     */
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Set identifier
     * 
     * @param  string $identifier Identifier
     * @return \core\Authenticator
     */
    public function setIdentifier($identifier)
    {
        $this->_identifier = $identifier;
        return $this;
    }

    /**
     * Set password
     * 
     * @param  string $password Password
     * @return \core\Authenticator
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * Set input identifier
     * 
     * @param  string $inputIdentifier Input identifier
     * @return \core\Authenticator
     */
    public function setInputIdentifier($inputIdentifier)
    {
        $this->_inputIdentifier = $inputIdentifier;
        return $this;
    }

    /**
     * Set input password
     * 
     * @param  string $inputPassword Input password
     * @return \core\Authenticator
     */
    public function setInputPassword($inputPassword)
    {
        $this->_inputPassword = $inputPassword;
        return $this;
    }

    /**
     * Get error
     * 
     * @return string
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * Authentificate
     * 
     * @return bool true or false if fails
     */
    public function authenticate()
    {
        /*if ($this->_inputIdentifier == $this->_identifier && $this->_inputPassword == $this->_password)
            return true;
        return false;*/
        if ($this->_inputIdentifier != $this->_identifier || $this->_inputPassword != $this->_password) {
            $this->_error = 'Неправильный логин или пароль';
            return false;
        }
        return true;
    }
}
