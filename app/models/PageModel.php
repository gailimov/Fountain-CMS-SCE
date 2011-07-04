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

    public function getWithCategory($pageNumber)
    {
        $paginator = new \Zend\Paginator\Paginator(
            new \Zend\Paginator\Adapter\DbSelect(
                $this->_db->select()
                          ->from($this->_table)
                          ->where('category_id IS NOT NULL')
                          ->order('created_at DESC')
                          ->order('id DESC')
            )
        );
        $paginator->setCurrentPageNumber($pageNumber)
                  ->setItemCountPerPage(1)
                  ->setPageRange(1);

        return $paginator;
    }

    public function getWithoutCategory()
    {
        $query = "SELECT slug, title FROM " . $this->_table . "
                  WHERE category_id IS NULL";
        return $this->_db->fetchAll($query);
    }

    public function getBySlug($slug)
    {
        $query = "SELECT * FROM " . $this->_table . "
                  WHERE slug = ?";
        return $this->_db->fetchRow($query, $slug);
    }

    public function getByCategoryId($categoryId)
    {
        $query = "SELECT * FROM " . $this->_table . "
                  WHERE category_id = ?
                  ORDER BY created_at DESC, id DESC";
        return $this->_db->fetchAll($query, $categoryId);
    }
}
