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


namespace app\models;

use core\Model;

/**
 * Config model
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class ConfigModel extends Model
{
    public function getConfig()
    {
        $query = "SELECT * FROM config";
        return $this->_db->fetchRow($query);
    }
}