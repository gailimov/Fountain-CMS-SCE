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
    core\Authenticator,
    core\Translator,
    core\http\Session,
    app\models\ManagerModel;

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

    /**
     * Manager model instance
     * 
     * @var app\models\ManagerModel
     */
    private $_managerModel;

    public function __construct()
    {
        parent::__construct();
        $this->_session = Session::getInstance();
        // Starting session
        $this->_session->start();
        $this->_language = Translator::load('dashboard', $this->_config['language']);
        $this->_managerModel = new ManagerModel();
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
        // Errors
        $errors = array();

        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost('user');

            // Validation
            if (empty($request['username']))
                $errors[] = 'Введите логин, пожалуйста';
            if (empty($request['password']))
                $errors[] = 'Введите пароль, пожалуйста';

            if (empty($errors)) {
                $auth = Authenticator::getInstance();

                $manager = $this->_managerModel->get();

                $auth->setIdentifier($manager['username'])
                     ->setPassword($manager['password'])
                     ->setInputIdentifier(htmlspecialchars(trim($request['username'])))
                     ->setInputPassword($request['password']);

                if ($auth->authenticate()) {
                    $this->_session->set('admin', md5($manager['username']));
                    $this->index();
                    die;
                } else {
                    $errors[] = $auth->getError();
                }
            }
        }

        $this->_smarty->assign('path', $this->_settings['url'] . DIRECTORY_SEPARATOR
                                                               . 'app'
                                                               . DIRECTORY_SEPARATOR
                                                               . $this->_config['themesFolder']
                                                               . DIRECTORY_SEPARATOR
                                                               . 'dashboard');
        $this->_smarty->assign('errors', $errors);
        if (isset($request)) $this->_smarty->assign('request', $request);
        $this->_smarty->display('admin/login.tpl');
    }

    public function logout()
    {
        $this->_session->destroy();
        header('location: ' . $this->_settings['url'] . '/admin');
        die;
    }

    /**
     * Is logged in?
     * 
     * @return bool
     */
    private function isLoggedIn()
    {
        //if (isset($this->_session->admin))
        if ($this->_session->has('admin'))
            return true;
        return false;
    }
}
