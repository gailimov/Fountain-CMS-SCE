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
     * Identity
     * 
     * @var string
     */
    private $_identity;

    /**
     * Credential
     * 
     * @var string
     */
    private $_credential;

    /**
     * Input identity
     * 
     * @var string
     */
    private $_inputIdentity;

    /**
     * Input credential
     * 
     * @var string
     */
    private $_inputCredential;

    /**
     * Error message
     * 
     * @var string
     */
    private $_errorMessage;

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
     * Set identity
     * 
     * @param  string $identity Identity
     * @return \core\Authenticator
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
        return $this;
    }

    /**
     * Set credential
     * 
     * @param  string $credential Credential
     * @return \core\Authenticator
     */
    public function setCredential($credential)
    {
        $this->_credential = $credential;
        return $this;
    }

    /**
     * Set input identity
     * 
     * @param  string $inputIdentity Input identity
     * @return \core\Authenticator
     */
    public function setInputIdentity($inputIdentity)
    {
        $this->_inputIdentity = $inputIdentity;
        return $this;
    }

    /**
     * Set input credential
     * 
     * @param  string $inputCredential Input credential
     * @return \core\Authenticator
     */
    public function setInputCredential($inputCredential)
    {
        $this->_inputCredential = $inputCredential;
        return $this;
    }

    /**
     * Set error message
     * 
     * @param  string $errorMessage Error message
     * @return \core\Authenticator
     */
    public function setErrorMessage($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
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
        if ($this->_inputIdentity != $this->_identity || $this->_inputCredential != $this->_credential) {
            $this->_error = $this->_errorMessage;
            return false;
        }
        return true;
    }
}
