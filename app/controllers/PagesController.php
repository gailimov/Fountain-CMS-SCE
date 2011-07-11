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


use core\Core;

require_once 'AdminController.php';

/**
 * Pages management controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PagesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 1)
    {
        $pagesCounter = $this->_pageModel->count();

        $page = $this->getPaginationRightPageNumber($page, $pagesCounter[0]['counter']);

        // Pagination
        $config = $this->getPaginationConfig($pagesCounter[0]['counter'],
                                             $this->_settings['url'] . '/admin/pages/page/',
                                             $page,
                                             $this->_perPage);
        $this->_pagify->initialize($config);

        $this->_smarty->assign('mainTitle', $this->_language['pages'] . ' | '
                                                                      . $this->_language['dashboard']
                                                                      . ' | ' . Core::NAME);
        $this->_smarty->assign('pages', $this->_pageModel->getAll(($page - 1) * $this->_perPage, $this->_perPage));
        $this->_smarty->assign('pagination', $this->_pagify->get_links());
    }

    public function add()
    {
        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost('page');

            // Validation
            if (empty($request['title']))
                $this->_errors[] = $this->_language['enterTitlePlease'];
            if (empty($request['slug']))
                $this->_errors[] = $this->_language['enterPermalinkPlease'];
            if (empty($request['content']))
                $this->_errors[] = $this->_language['enterContentPlease'];

            // If data is valid
            if (empty($this->_errors)) {
                if ($this->_pageModel->add($request)) {
                    $this->index();
                    $this->_smarty->assign('success', $this->_language['pageAdded']);
                    $this->render('pages/index');
                    die;
                }
            }
        }

        $this->_smarty->assign('plugins', $this->_pluginModel->getAll());
        if (isset($request)) $this->_smarty->assign('request', $request);
        $this->_smarty->assign('errors', $this->_errors);
    }

    public function edit($id)
    {
        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost('page');

            // Validation
            if (empty($request['title']))
                $this->_errors[] = $this->_language['enterTitlePlease'];
            if (empty($request['slug']))
                $this->_errors[] = $this->_language['enterPermalinkPlease'];
            if (empty($request['content']))
                $this->_errors[] = $this->_language['enterContentPlease'];

            // If data is valid
            if (empty($this->_errors)) {
                if ($this->getRequest()->has('save')) {
                    if ($this->_pageModel->update($request, $id)) {
                        $this->index();
                        $this->_smarty->assign('success', $this->_language['pageSaved']);
                        $this->render('pages/index');
                        die;
                    }
                } elseif ($this->getRequest()->has('delete')) {
                    if ($this->_pageModel->delete($id)) {
                        $this->index();
                        $this->_smarty->assign('success', $this->_language['pageDeleted']);
                        $this->render('pages/index');
                        die;
                    }
                }
            }
        }

        $this->_smarty->assign('page', $this->_pageModel->getById($id));
        $this->_smarty->assign('plugins', $this->_pluginModel->getAll());
        $this->_smarty->assign('errors', $this->_errors);
    }
}
