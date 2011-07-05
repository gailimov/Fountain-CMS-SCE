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


namespace app\plugins\feedback\controllers;

use core\PluginController,
    core\PluginInterface,
    core\Config,
    core\Translator,
    app\models\ConfigModel,
    app\plugins\feedback\models\ManagerModel;

/**
 * Feedback plugin's controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
final class FeedbackController extends PluginController implements PluginInterface
{
    /**
     * Singleton instance
     * 
     * @var app\plugins\feedback\controllers\FeedbackController
     */
    private static $_instance;

    /**
     * Plugin name
     * 
     * @var string
     */
    private $_plugin = 'feedback';

    /**
     * Config
     * 
     * @var array
     */
    private $_config;

    /**
     * Language
     * 
     * @var string
     */
    private $_language;

    public function __construct()
    {
        parent::__construct($this->_plugin);
        $this->_config = Config::load('application');
        $this->_language = Translator::load('feedback', $this->_config['language'], 'feedback');
    }

    private function __clone()
    {}

    /**
     * Get singleton instance
     * 
     * @return app\plugins\feedback\controllers\FeedbackController
     */
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function index()
    {
        $managerModel = new ManagerModel();
        $configModel = new ConfigModel();
        $manager = $managerModel->get();
        $settings = $configModel->get();

        if ($this->_request->isPost()) {
            $request = $this->_request->getPost('contactForm');
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: ' . htmlspecialchars(trim($request['name'])) . ' <' . htmlspecialchars(trim($request['email'])) . '>' . "\r\n";
            $subject = 'Письмо с сайта «' . $settings['title'] . '»';
            $message = nl2br('<p>Автор: ' . htmlspecialchars(trim($request['name'])) . '</p><p>Текст письма:</p><p>' . htmlspecialchars(trim($request['message'])) . '</p>');
            //mail($manager['email'], $subject, $message, $headers);
        }

        $this->_smarty->assign('lang', $this->_language);
        return $this->_smarty->fetch('feedback.tpl');
    }
}
