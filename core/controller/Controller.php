<?php

/**
 * Fountain CMS Site Card Edition
 * 
 * Ligthweight content management system for site cards and minisites
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) Kanat Gailimov (http://gailimov.info) 2011
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */


namespace core\controller;

use core\controller\Router;

require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'core'
                       . DIRECTORY_SEPARATOR . 'controller'
                       . DIRECTORY_SEPARATOR . 'Router.php';

/**
 * Front Controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Controller
{
    private function __construct()
    {}

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
