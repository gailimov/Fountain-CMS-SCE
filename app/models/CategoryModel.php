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
 * Category model
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class CategoryModel extends Model
{
    /**
     * Table
     * 
     * @var string
     */
    private $_table = 'category';

    public function getAll()
    {
        $query = "SELECT id, slug, title FROM " . $this->_table;
        return $this->_db->fetchAll($query);
    }

    public function getBySlug($slug)
    {
        $query = "SELECT id, title, description FROM " . $this->_table . "
                  WHERE slug = ?";
        return $this->_db->fetchRow($query, $slug);
    }
}
