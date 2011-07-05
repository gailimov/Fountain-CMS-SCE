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

use core\PluginView,
    core\Registry,
    core\controller\Request;

/**
 * Plugins controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PluginController
{
    /**
     * Request
     * 
     * @var \core\Request
     */
    protected $_request;

    /**
     * View
     * 
     * @var \core\PluginView
     */
    private $_view;

    /**
     * Smarty
     * 
     * @var \Smarty
     */
    protected $_smarty;

    public function __construct($plugin)
    {
        $this->_request = new Request();
        $this->_view = new PluginView($plugin);
        $this->_smarty = Registry::get('pluginsSmarty');
    }
}
