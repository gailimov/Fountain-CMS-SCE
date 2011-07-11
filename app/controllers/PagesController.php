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

    public function edit($id)
    {
        // Errors
        $errors = array();
        // Success message
        $success = null;

        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost('page');

            // Validation
            if (empty($request['title']))
                $errors[] = $this->_language['enterTitlePlease'];
            if (empty($request['slug']))
                $errors[] = $this->_language['enterPermalinkPlease'];
            if (empty($request['content']))
                $errors[] = $this->_language['enterContentPlease'];

            // If data is valid
            if (empty($errors)) {
                if ($this->getRequest()->has('save')) {
                    if ($this->_pageModel->update($this->getRequest()->getPost('page'), $id))
                        $success = $this->_language['pageSaved'];
                }
            }
        }

        $this->_smarty->assign('page', $this->_pageModel->getById($id));
        $this->_smarty->assign('plugins', $this->_pluginModel->getAll());
        $this->_smarty->assign('errors', $errors);
        $this->_smarty->assign('success', $success);
    }
}
