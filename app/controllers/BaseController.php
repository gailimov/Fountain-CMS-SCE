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


namespace app\controllers;

use core\Controller,
    core\Config,
    app\models\ConfigModel,
    app\models\PageModel,
    app\models\CategoryModel;

/**
 * Application's base controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class BaseController extends Controller
{
    /**
     * Config
     * 
     * @var array
     */
    protected $_config;

    /**
     * Config model instance
     * 
     * @var \app\models\ConfigModel
     */
    protected $_configModel;

    /**
     * Page model instance
     * 
     * @var \app\models\PageModel
     */
    protected $_pageModel;

    /**
     * Category model instance
     * 
     * @var \app\models\CategoryModel
     */
    protected $_categoryModel;

    /**
     * Settings
     * 
     * @var array
     */
    protected $_settings = array();

    public function __construct()
    {
        parent::__construct();
        $this->_config = Config::load('application');
        $this->_smarty->assign('themePath',
                               'http://projects.loc/site-card'
                               . DIRECTORY_SEPARATOR . 'app'
                               . DIRECTORY_SEPARATOR . $this->_config['themesFolder']
                               . DIRECTORY_SEPARATOR . $this->_config['defaultTheme']
                               . DIRECTORY_SEPARATOR);
        $this->_configModel = new ConfigModel();
        $this->_settings = $this->_configModel->get();
        $this->_smarty->assign('url', $this->_settings['url']);
        $this->_smarty->assign('title', $this->_settings['title']);
        $this->_smarty->assign('mainTitle', $this->_settings['title']);
        $this->_smarty->assign('description', $this->_settings['description']);
        $this->_pageModel = new PageModel();
        $this->_smarty->assign('menu', $this->_pageModel->getWithoutCategory());
        $this->_categoryModel = new CategoryModel();
        $this->_smarty->assign('categories', $this->_categoryModel->getAll());
    }
}
