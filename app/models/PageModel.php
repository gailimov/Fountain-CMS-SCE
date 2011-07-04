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
 * Page model
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class PageModel extends Model
{
    /**
     * Table
     * 
     * @var string
     */
    private $_table = 'page';

    public function getWithCategory($start, $perPage)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE category_id IS NOT NULL
                  LIMIT {$start}, {$perPage}";
        return $this->_db->fetchAll($query);
    }

    public function getWithoutCategory()
    {
        $query = "SELECT slug, title
                  FROM " . $this->_table . "
                  WHERE category_id IS NULL";
        return $this->_db->fetchAll($query);
    }

    public function getBySlug($slug)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE slug = ?";
        return $this->_db->fetchRow($query, $slug);
    }

    public function getByCategoryId($categoryId, $start, $perPage)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE category_id = ?
                  ORDER BY created_at DESC, id DESC
                  LIMIT {$start}, {$perPage}";
        return $this->_db->fetchAll($query, $categoryId);
    }

    public function countWithCategory()
    {
        $query = "SELECT COUNT(id) AS counter
                  FROM " . $this->_table . "
                  WHERE category_id IS NOT NULL";
        return $this->_db->fetchAll($query);
    }

    public function countByCategoryId($categoryId)
    {
        $query = "SELECT COUNT(id) AS counter
                  FROM " . $this->_table . "
                  WHERE category_id = ?";
        return $this->_db->fetchAll($query, $categoryId);
    }
}
