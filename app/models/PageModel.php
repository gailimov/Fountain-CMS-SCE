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
    public function getPagesWithCategory()
    {
        $query = "SELECT * FROM page
                  WHERE category_id IS NOT NULL
                  ORDER BY created_at DESC, id DESC";
        return $this->_db->fetchAll($query);
    }

    public function getPagesWithoutCategory()
    {
        $query = "SELECT slug, title FROM page
                  WHERE category_id IS NULL";
        return $this->_db->fetchAll($query);
    }

    public function getPageBySlug($slug)
    {
        $query = "SELECT * FROM page
                  WHERE slug = ?";
        return $this->_db->fetchRow($query, $slug);
    }
}
