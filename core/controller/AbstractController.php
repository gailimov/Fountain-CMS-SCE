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

use core\http\Request;

/**
 * Controller abstract class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
abstract class AbstractController
{
    /**
     * Request
     * 
     * @var \core\http\Request
     */
    private $_request;

    public function __construct()
    {
        $this->_request = new Request();
    }

    /**
     * Get request
     * 
     * @return \core\http\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }
}
