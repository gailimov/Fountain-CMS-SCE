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
    core\Config,
    core\Translator;

/**
 * Feedback plugin's controller
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class FeedbackController extends PluginController
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
        if ($this->_request->isPost()) {
            $request = $this->_request->getPost('contactForm');
            $name = $request['name'];
            echo $name;
        }
        $this->_smarty->assign('lang', $this->_language);
        return $this->_smarty->fetch('feedback.tpl');
    }
}
