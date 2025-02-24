<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\MovieResource;
use App\Services\CommonService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getList(Request $request)
    {
        $page = $request->input('page', 1);
        $item = $request->input('item', 10);
        $keyword = $request->input('keyword', '');

        $data = CommonService::getModel('Movies')->getList([
            'page' => $page,
            'item' => $item,
            'keyword' => $keyword,
        ]);

        return $this->getListPaginate(MovieResource::collection($data));
    }
}
