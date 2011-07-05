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


use app\controllers\BaseController,
    core\Core,
    app\plugins\feedback\controllers\FeedbackController;

/**
 * Site controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class SiteController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 1)
    {
        $postsCounter = $this->_pageModel->countWithCategory();

        $page = $this->getPaginationRightPageNumber($page, $postsCounter[0]['counter']);

        if ($page > 1)
            $this->_smarty->assign('mainTitle',
                                   $this->_settings['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_language['page'] . ' ' . $page);

        // Pagination
        $config = $this->getPaginationConfig($postsCounter[0]['counter'],
                                             $this->_settings['url'] . '/pages/',
                                             $page,
                                             $this->_perPage);
        $this->_pagify->initialize($config);

        $this->_smarty->assign('pages', $this->_pageModel->getWithCategory(($page - 1) * $this->_perPage,
                                                                            $this->_perPage));
        $this->_smarty->assign('pagination', $this->_pagify->get_links());
        $this->_smarty->display('pages.tpl');
    }

    public function page($slug = '')
    {
        $page = $this->_pageModel->getBySlug($slug);

        if (!$page)
            Core::show404('page');

        $this->_smarty->assign('plugin', FeedbackController::getInstance()->index());
        $this->_smarty->assign('mainTitle',
                               $page['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title']);
        $this->_smarty->assign('pageTitle', $page['title']);
        $this->_smarty->assign('description', $page['description']);
        $this->_smarty->assign('content', $page['content']);
        $this->_smarty->assign('pagePluginId', $page['plugin_id']);
        $this->_smarty->display('page.tpl');
    }

    public function category($slug = '', $page = 1)
    {
        $category = $this->_categoryModel->getBySlug($slug);

        $postsCounter = $this->_pageModel->countByCategoryId($category['id']);

        $page = $this->getPaginationRightPageNumber($page, $postsCounter[0]['counter']);

        if ($page > 1)
            $this->_smarty->assign('mainTitle',
                                   $category['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_language['page'] . ' ' . $page);
        else
            $this->_smarty->assign('mainTitle',
                                   $category['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title']);

        // Pagination
        $config = $this->getPaginationConfig($postsCounter[0]['counter'],
                                             $this->_settings['url'] . '/category/' . $slug . '/pages/',
                                             $page,
                                             $this->_perPage);
        $this->_pagify->initialize($config);

        $pages = $this->_pageModel->getByCategoryId($category['id'], ($page - 1) * $this->_perPage, $this->_perPage);
        if (!$pages)
            Core::show404('page');

        $this->_smarty->assign('description', $category['description']);
        $this->_smarty->assign('pages', $pages);
        $this->_smarty->assign('pagination', $this->_pagify->get_links());
        $this->_smarty->display('pages.tpl');
    }
}
