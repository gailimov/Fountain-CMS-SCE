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
    core\Translator,
    core\http\Session;

/**
 * Admin panel controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class AdminController extends BaseController
{
    /**
     * Session class instance
     * 
     * @var \core\http\Session
     */
    private $_session;

    public function __construct()
    {
        parent::__construct();
        $this->_language = Translator::load('dashboard', $this->_config['language']);
        $this->_session = Session::getInstance();
        $this->_smarty->template_dir = APP_PATH . $this->_config['themesFolder']
                                                . DIRECTORY_SEPARATOR
                                                . 'dashboard'
                                                . DIRECTORY_SEPARATOR;
        $this->setLayout('dashboard/layouts/dashboard');
        $this->_smarty->assign('lang', $this->_language);
        $this->_smarty->assign('name', Core::NAME);
        $this->_smarty->assign('version', Core::VERSION);
    }

    public function index()
    {
        if ($this->isLoggedIn())
            echo 'Dashboard';
        else
            $this->login();
    }

    public function login()
    {
        $this->_smarty->assign('path', $this->_settings['url'] . DIRECTORY_SEPARATOR
                                                               . 'app'
                                                               . DIRECTORY_SEPARATOR
                                                               . $this->_config['themesFolder']
                                                               . DIRECTORY_SEPARATOR
                                                               . 'dashboard');
        $this->_smarty->display('admin/login.tpl');
    }

    public function logout()
    {
        
    }

    /**
     * Is logged in?
     * 
     * @return bool
     */
    private function isLoggedIn()
    {
        if (isset($this->_session->admin))
            return true;
        return false;
    }
}
