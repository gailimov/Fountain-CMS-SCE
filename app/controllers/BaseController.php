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
    core\Translator,
    app\models\ConfigModel,
    app\models\PageModel,
    app\models\CategoryModel,
    app\models\PluginModel;

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
     * Language
     * 
     * @var string
     */
    protected $_language;

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
     * Plugin model instance
     * 
     * @var \app\models\PluginModel
     */
    protected $_pluginModel;

    /**
     * Settings
     * 
     * @var array
     */
    protected $_settings = array();

    /**
     * Instance of Pagify
     * 
     * @var \Pagify
     */
    protected $_pagify;

    /**
     * Number of entries on a page
     * 
     * @var int
     */
    protected $_perPage = 1;

    public function __construct()
    {
        parent::__construct();
        $this->_config = $this->getConfig();
        $this->_language = Translator::load('interface', $this->_config['language']);
        $this->_configModel = new ConfigModel();
        $this->_settings = $this->_configModel->get();
        $this->_smarty->assign('themePath',
                               $this->_settings['url']
                               . DIRECTORY_SEPARATOR . 'app'
                               . DIRECTORY_SEPARATOR . $this->_config['themesFolder']
                               . DIRECTORY_SEPARATOR . $this->_config['defaultTheme']
                               . DIRECTORY_SEPARATOR);
        $this->_smarty->assign('url', $this->_settings['url']);
        $this->_smarty->assign('title', $this->_settings['title']);
        $this->_smarty->assign('mainTitle', $this->_settings['title']);
        $this->_smarty->assign('description', $this->_settings['description']);
        $this->_smarty->assign('lang', $this->_language);
        $this->_pageModel = new PageModel();
        $this->_smarty->assign('menu', $this->_pageModel->getWithoutCategory());
        $this->_categoryModel = new CategoryModel();
        $this->_smarty->assign('categories', $this->_categoryModel->getAll());
        $this->_pluginModel = new PluginModel();
        $this->_pagify = new \Pagify();
    }

    /**
     * Get right page number for pagination
     * 
     * Examples:
     *     Number of pages is a 10. Then:
     *     http://site.com/pages/-1 == http://site.com/pages/1
     *     http://site.com/pages/0 == http://site.com/pages/1
     *     http://site.com/pages/100000 == http://site.com/pages/10
     * 
     * @param  int $page         Page number
     * @param  int $postsCounter Count of posts
     * @return int
     */
    protected function getPaginationRightPageNumber($page, $postsCounter)
    {
        $page = (int) $page;

        if ($page > $postsCounter)
            $page = $postsCounter;
        elseif ($page <= 0)
            $page = 1;

        return $page;
    }

    /**
     * Get pagination config
     * 
     * @param  int    $total   Total number of objects
     * @param  string $url     URL
     * @param  int    $page    Current page
     * @param  int    $perPage Number of objects on a page
     * @return array
     */
    protected function getPaginationConfig($total, $url, $page, $perPage)
    {
        return array(
            'total'           => $total,
            'url'             => $url,
            'page'            => $page,
            'per_page'        => $perPage,
            'prev_link_text'  => $this->_language['previous'],
            'next_link_text'  => $this->_language['next'],
            'first_link_text' => $this->_language['first'],
            'last_link_text'  => $this->_language['last']
        );
    }
}
