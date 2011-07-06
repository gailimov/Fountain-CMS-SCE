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
 * Plugin model
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PluginModel extends Model
{
    /**
     * Table
     * 
     * @var string
     */
    private $_table = 'plugin';

    public function getByid($id)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE id = ?
                  LIMIT 1";
        return $this->_db->fetchRow($query, $id);
    }
}
