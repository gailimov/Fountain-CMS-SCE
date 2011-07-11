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

    public function getAll($start, $perPage)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  ORDER BY created_at DESC, id DESC
                  LIMIT {$start}, {$perPage}";
        return $this->_db->fetchAll($query);
    }

    public function getWithCategory($start, $perPage)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE category_id != 0
                  ORDER BY created_at DESC, id DESC
                  LIMIT {$start}, {$perPage}";
        return $this->_db->fetchAll($query);
    }

    public function getWithoutCategory()
    {
        $query = "SELECT slug, title
                  FROM " . $this->_table . "
                  WHERE category_id = 0";
        return $this->_db->fetchAll($query);
    }

    public function getById($id)
    {
        $query = "SELECT *
                  FROM " . $this->_table . "
                  WHERE id = ?";
        return $this->_db->fetchRow($query, $id);
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

    public function count()
    {
        $query = "SELECT COUNT(id) AS counter
                  FROM " . $this->_table;
        return $this->_db->fetchAll($query);
    }

    public function countWithCategory()
    {
        $query = "SELECT COUNT(id) AS counter
                  FROM " . $this->_table . "
                  WHERE category_id != 0";
        return $this->_db->fetchAll($query);
    }

    public function countByCategoryId($categoryId)
    {
        $query = "SELECT COUNT(id) AS counter
                  FROM " . $this->_table . "
                  WHERE category_id = ?";
        return $this->_db->fetchAll($query, $categoryId);
    }

    public function add($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->_db->insert($this->_table, $data);
        return true;
    }

    public function update($data, $id)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->_db->update($this->_table, $data, 'id = ' . $id);
        return true;
    }

    public function delete($id)
    {
        $this->_db->delete($this->_table, 'id = ' . $id);
        return true;
    }
}
