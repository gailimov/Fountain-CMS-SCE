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
 * Plugins view class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PluginView
{
    public function __construct($plugin)
    {
        $smarty = new \Smarty();
        $smarty->template_dir = APP_PATH . 'plugins' . DIRECTORY_SEPARATOR . $plugin
                                                     . DIRECTORY_SEPARATOR . 'views'
                                                     . DIRECTORY_SEPARATOR;
        $smarty->compile_dir  = ROOT_PATH . 'data' . DIRECTORY_SEPARATOR . 'themes_c' . DIRECTORY_SEPARATOR;
        Registry::set('pluginsSmarty', $smarty);
    }
}
