<?php

namespace App\Models;

use App\Support\Constants;

class Movies extends BaseRepository
{
    public function __construct() {
        parent::__construct('Movies');
    }

    public function getList($params)
    {
        $params = array_merge([
            'item' => null,
            'page' => null,
            'keyword' => '',
            'orderBy' => [
                'updated_at' => Constants::ORDER_BY_DESC,
            ],
        ], $params);

        $where = [];
        if (!empty($params['keyword'])) {
            $where = [
                'title' => ['like', '%' . $params['keyword'] . '%'],
            ];
        };

        return $this->getData([
            'type' => 2,
            'where' => $where,
            'item' => $params['item'],
            'page' => $params['page'],
            'orderBy' => $params['orderBy']
        ]);
    }
}
