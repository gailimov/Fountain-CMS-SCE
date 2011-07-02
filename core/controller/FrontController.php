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

/**
 * Front Controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class FrontController
{
    /**
     * Singleton instance
     * 
     * @var \core\controller\Controller
     */
    private static $_instance;

    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @return \core\controller\Controller
     */
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Running of router
     * 
     * @return void
     */
    public function run()
    {
        $request = new Router();
        $request->dispatch();
    }
}
