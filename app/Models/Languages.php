<?php

namespace App\Models;

class Languages extends BaseRepository
{
    public function __construct() {
        parent::__construct('Languages');
    }

    public function getList()
    {
        return $this->getData([
            'type' => 2,
        ]);
    }
}
