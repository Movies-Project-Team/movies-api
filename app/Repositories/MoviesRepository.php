<?php

namespace App\Repositories;

class MoviesRepository extends BaseRepository
{
    public function __construct() {
        parent::__construct('Movies');
    }
}
