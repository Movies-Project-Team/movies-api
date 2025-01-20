<?php

namespace App\Models;

class Movies extends BaseRepository
{
    public function __construct() {
        parent::__construct('Movies');
    }
}
