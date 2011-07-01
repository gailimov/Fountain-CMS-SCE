<?php

use core\Db,
    core\View,
    core\Registry,
    app\models\Post;

class SiteController
{
    public function index($name = 'Kanat')
    {
        $view = new View();
        $smarty = Registry::get('smarty');
        $smarty->assign('name', $name);
        $smarty->display('index.tpl');
    }
    
    public function post()
    {
        $model = new Post();
        $posts = $model->getPosts();
        print_r($posts);
    }
}
