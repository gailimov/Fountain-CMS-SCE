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

use core\Exception as CoreException;

/**
 * Not found exception
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class NotFoundException extends CoreException
{
    /**
     * Show 404 error
     * 
     * @return void
     */
    public function show404()
    {
        header("HTTP/1.1 404 Not Found");
        if ($this->getMessage() == '') {
            die('Error 404: not found');
        }
        die('Error 404: ' . $this->getMessage());
    }
}
