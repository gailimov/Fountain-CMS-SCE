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


namespace core;

/**
 * Plugin's interface
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
interface PluginInterface
{
    public function __construct();

    /**
     * Get singleton instance
     * 
     * @return obj
     */
    public static function getInstance();

    public function index();
}
