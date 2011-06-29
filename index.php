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

use core\controller\Controller;

/** Defining of root path */
defined('ROOT_PATH') || define('ROOT_PATH', 
                               dirname(__FILE__) . DIRECTORY_SEPARATOR);

/** Loading of the front controller */
require_once ROOT_PATH . 'core' . DIRECTORY_SEPARATOR . 'controller'
                                . DIRECTORY_SEPARATOR . 'Controller.php';

/** Running of the front controller */
Controller::run();
