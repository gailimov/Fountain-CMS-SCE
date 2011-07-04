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
    core\Core;

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

    public function index()
    {
        if (isset($_GET['page']))
            $pageNumber = (int) $_GET['page'];
        else
            $pageNumber = 1;
        $this->_smarty->assign('pages', $this->_pageModel->getWithCategory($pageNumber));
        $this->_smarty->display('pages.tpl');
    }

    public function page($slug = '')
    {
        $page = $this->_pageModel->getBySlug($slug);
        if (!$page)
            Core::show404('page');
        $this->_smarty->assign('mainTitle',
                               $page['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title']);
        $this->_smarty->assign('pageTitle', $page['title']);
        $this->_smarty->assign('description', $page['description']);
        $this->_smarty->assign('content', $page['content']);
        $this->_smarty->display('page.tpl');
    }

    public function category($category = '')
    {
        $category = $this->_categoryModel->getBySlug($category);
        $pages = $this->_pageModel->getByCategoryId($category['id']);
        if (!$pages)
            Core::show404('page');
        $this->_smarty->assign('mainTitle',
                               $category['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title']);
        $this->_smarty->assign('description', $category['description']);
        $this->_smarty->assign('pages', $pages);
        $this->_smarty->display('pages.tpl');
    }
}
