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

use core\http\Request,
    core\http\Response;

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

    /**
     * Response
     * 
     * @var \core\http\Response
     */
    private $_response;

    public function __construct()
    {
        $this->_request = new Request();
        $this->_response = new Response();
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

    /**
     * Get response
     * 
     * @return \core\http\Response
     */
    public function getResponse()
    {
        return $this->_response;
    }
}
