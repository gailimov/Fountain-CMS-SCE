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


/** Single entry point */

use core\Loader;
use core\controller\Controller;

/** Defining of paths */
defined('ROOT_PATH') || define('ROOT_PATH',
                               dirname(__FILE__) . DIRECTORY_SEPARATOR);
defined('APP_PATH')  || define('APP_PATH',
                               ROOT_PATH . 'app' . DIRECTORY_SEPARATOR);

/** Autoloading */
require_once ROOT_PATH . 'core' . DIRECTORY_SEPARATOR . 'Loader.php';
Loader::register();

/** Running of the front controller */
Controller::getInstance()->run();
