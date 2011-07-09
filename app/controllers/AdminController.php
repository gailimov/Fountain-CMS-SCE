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
        $this->_smarty->assign('path', $this->_settings['url'] . DIRECTORY_SEPARATOR
                                                               . 'app'
                                                               . DIRECTORY_SEPARATOR
                                                               . $this->_config['themesFolder']
                                                               . DIRECTORY_SEPARATOR
                                                               . 'dashboard');
        $this->_smarty->assign('lang', $this->_language);
        $this->_smarty->assign('name', Core::NAME);
        $this->_smarty->assign('version', Core::VERSION);
        // if not logged in - redorect to login page
        if (!$this->isLoggedIn()) {
            $this->login();
            die;
        }
    }

    public function index()
    {
        if ($this->isLoggedIn())
            $this->_smarty->assign('mainTitle', $this->_language['dashboard'] . ' | ' . Core::NAME);
        else
            $this->login();
    }

    public function login()
    {
        if (!$this->isLoggedIn()) {
            // Errors
            $errors = array();

            if ($this->getRequest()->isPost()) {
                $request = $this->getRequest()->getPost('user');

                // Validation
                if (empty($request['username']))
                    $errors[] = $this->_language['enterYourUsernamePlease'];
                if (empty($request['password']))
                    $errors[] = $this->_language['enterYourPasswordPlease'];

                if (empty($errors)) {
                    $auth = Authenticator::getInstance();

                    $manager = $this->_managerModel->get();

                    $auth->setIdentity($manager['username'])
                         ->setCredential($manager['password'])
                         ->setInputIdentity(htmlspecialchars(trim($request['username'])))
                         ->setInputCredential($request['password'])
                         ->setErrorMessage($this->_language['wrongUsernameOrPassword']);

                    if ($auth->authenticate()) {
                        $this->_session->admin = md5($manager['username']);
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
        } else {
            $this->getResponse()->redirect($this->_settings['url'] . '/admin');
        }
    }

    public function logout()
    {
        $this->_session->destroy();
        $this->getResponse()->redirect($this->_settings['url'] . '/admin');
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
