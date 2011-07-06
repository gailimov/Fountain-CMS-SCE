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

use core\controller\AbstractController,
    core\PluginView,
    core\Registry,
    core\http\Request;

/**
 * Plugins controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PluginController extends AbstractController
{
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
        parent::__construct();
        $this->_view = new PluginView($plugin);
        $this->_smarty = Registry::get('pluginsSmarty');
    }
}
