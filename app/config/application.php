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


/** Application config */
return array(
    'defaultController' => 'SiteController',
    'themesFolder'      => 'themes',
    'defaultTheme'      => 'default',
    'titleSeparator'    => '|',
    'language'          => 'ru',
    'db' => array(
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '1',
        'dbname'   => 'projects_sitecard',
        'charset'  => 'utf8'
    ),
    'smtp' => array(
        'host'       => 'smtp.gmail.com',
        'username'   => '',
        'password'   => '',
        'port'       => '465', // 587
        'encryption' => 'ssl' // tls
    )
);
