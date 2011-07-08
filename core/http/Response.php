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
 * HTTP response class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Response
{
    /**
     * Redirect
     * 
     * @param  string $url URL
     * @todo   Use HTTP code
     * @return void
     */
    public function redirect($url, $code = 302)
    {
        header('location: ' . $url);
        die;
    }
}
