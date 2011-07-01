<?php

use core\View,
    core\Registry;

class SiteController
{
    public function index($name = 'Kanat')
    {
        $view = new View();
        $smarty = Registry::get('smarty');
        $smarty->assign('name', $name);
        $smarty->display('index.tpl');
    }
}
