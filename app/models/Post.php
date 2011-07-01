<?php

namespace app\models;

use core\Db;

class Post extends Db
{
    public function getPosts()
    {
        $db = $this->getConnection();
        $query = "SELECT * FROM sfb_post";
        return $result = $db->fetchAll($query);
    }
}
