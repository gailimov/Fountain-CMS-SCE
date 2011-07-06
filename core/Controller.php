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

use core\View,
    core\Registry,
    core\controller\Request;

/**
 * Base controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Controller
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
     * @var \core\View
     */
    private $_view;

    /**
     * Smarty
     * 
     * @var \Smarty
     */
    protected $_smarty;

    public function __construct()
    {
        $this->_request = new Request();
        $this->_view = new View();
        $this->_smarty = Registry::get('smarty');
    }

    /**
     * Render partial template
     * 
     * @param  string $template Template
     * @return void
     */
    public function render($template = null)
    {
        $config = Config::load('application');

        if ($template == null)
            $content = mb_strtolower($this->_smarty->template_dir . $this->_request->getController()
                                                                  . DIRECTORY_SEPARATOR
                                                                  . $this->_request->getAction()
                                                                  . $config['templateExtension']);
        else
            $content = $this->_smarty->template_dir . $template . $config['templateExtension'];

        try {
            if (!file_exists($content))
                throw new Exception('Template file "' . $content . '" not found');
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $this->_smarty->assign('content', $content);
        $this->_smarty->display($config['layoutsFolder'] . DIRECTORY_SEPARATOR . $config['layoutName'] . $config['templateExtension']);
    }
}
