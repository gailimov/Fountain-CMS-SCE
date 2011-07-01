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

use core\Registry;

/**
 * View class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class View
{
    public function __construct()
    {
        $config = Config::load('application');
        $smarty = new \Smarty();
        $smarty->template_dir = APP_PATH . $config['themesFolder'] . DIRECTORY_SEPARATOR
                                                . $config['defaultTheme'] . DIRECTORY_SEPARATOR;
        $smarty->compile_dir  = ROOT_PATH . 'data' . DIRECTORY_SEPARATOR . 'themes_c' . DIRECTORY_SEPARATOR;
        Registry::set('smarty', $smarty);
    }
}
