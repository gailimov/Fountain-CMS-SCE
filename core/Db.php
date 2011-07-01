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
 * Database class
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Db
{
    /**
     * PDO object
     * 
     * @var \PDO
     */
    private $_connection;

    public function __construct()
    {
        $config = Config::load('application');
        $this->_connection = new \Zend\Db\Adapter\PdoMysql(array(
            'host'     => $config['db']['host'],
            'username' => $config['db']['username'],
            'password' => $config['db']['password'],
            'dbname'   => $config['db']['dbname']
        ));
    }

    /**
     * Get database connection resource
     * 
     * @return object
     */
    public function getConnection()
    {
        return $this->_connection;
    }
}
