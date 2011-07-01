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
 * Core
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Core
{
    /**
     * Show 404 error
     * 
     * @param  string $page Page name
     * @return void
     */
    public static function show404($page = '')
    {
        header("HTTP/1.1 404 Not Found");
        die('Error 404: ' . $page . ' not found');
    }
}
