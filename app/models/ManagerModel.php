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

use core\Model,
    core\Registry;

/**
 * Manager model
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class ManagerModel extends Model
{
    /**
     * Table
     * 
     * @var string
     */
    private $_table = 'manager';

    public function get()
    {
        $lang = Registry::get('dashboard_i18n');
        $query = "SELECT *, DATE_FORMAT(login_at, '%d.%m.%Y " . $lang['at'] . " %H:%i') AS formatted_login_at
                  FROM " . $this->_table;
        return $this->_db->fetchRow($query);
    }
}
