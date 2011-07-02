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


use app\controllers\BaseController;

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
        $this->_smarty->assign('pages', $this->_pageModel->getPagesWithCategory());
        $this->_smarty->display('pages.tpl');
    }

    public function page($slug)
    {
        $page = $this->_pageModel->getPageBySlug($slug);
        $this->_smarty->assign('mainTitle',
                               $page['title'] . ' ' . $this->_config['titleSeparator'] . ' ' . $this->_settings['title']);
        $this->_smarty->assign('pageTitle', $page['title']);
        $this->_smarty->assign('description', $page['description']);
        $this->_smarty->assign('content', $page['content']);
        $this->_smarty->display('page.tpl');
    }
}
