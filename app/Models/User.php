<?php

namespace App\Models;

class User extends BaseRepository
{
    public function __construct() {
        parent::__construct('User');
    }   
}
