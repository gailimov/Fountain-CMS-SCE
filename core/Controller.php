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
    core\View,
    core\Registry,
    core\http\Request;

/**
 * Base controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Controller extends AbstractController
{
    /**
     * Config
     * 
     * @var array
     */
    private $_config;

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

    /**
     * Layout
     * 
     * @var string
     */
    private $_layout;

    public function __construct()
    {
        parent::__construct();
        $this->_config = Config::load('application');
        $this->_view = new View();
        $this->_smarty = Registry::get('smarty');
    }

    /**
     * Get config
     * 
     * @return array
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Set layout
     * 
     * @param  string $layout Layout
     * @return obj
     */
    public function setLayout($layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Get layout
     * 
     * @return string
     */
    public function getLayout()
    {
        return APP_PATH . $this->_config['themesFolder']
                        . DIRECTORY_SEPARATOR
                        . $this->_layout
                        . $this->_config['templateExtension'];
    }

    /**
     * Render partial template
     * 
     * @param  string $template Template
     * @return void
     */
    public function render($template = null)
    {
        if ($template == null)
            $content = mb_strtolower($this->_smarty->template_dir . $this->getRequest()->getController()
                                                                  . DIRECTORY_SEPARATOR
                                                                  . $this->getRequest()->getAction()
                                                                  . $this->_config['templateExtension']);
        else
            $content = $this->_smarty->template_dir . $template . $this->_config['templateExtension'];

        try {
            if (!file_exists($content))
                throw new Exception('Template file "' . $content . '" not found');
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $this->_smarty->assign('content', $content);

        if (empty($this->_layout))
            $this->_smarty->display($this->_config['layoutsFolder'] . DIRECTORY_SEPARATOR
                                                                    . $this->_config['layoutName']
                                                                    . $this->_config['templateExtension']);
        else
            $this->_smarty->display($this->getLayout());
    }
}
