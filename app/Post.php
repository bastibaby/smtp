<?php

namespace App;

use App\Wordpress;

class Post extends Wordpress
{
    public function __construct($postType = '')
    {
        $this->postType = $postType;
    }
    
}
