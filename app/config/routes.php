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


/** Routes config */
return array(
    // http://site.com/pages/2
    '/pages\/([0-9]+)/' => 'site/index/$1',
    // http://site.com/page/some-page
    '/page\/([-_a-z0-9]+)/' => 'site/page/$1',
    // http://site.com/category/some-category
    '/category\/([-_a-z0-9]+)/' => 'site/category/$1',
    // http://site.com/category/some-category/pages/2
    '/category\/([-_a-z0-9]+)\/pages\/([0-9]+)/' => 'site/category/$1/$2'
);
