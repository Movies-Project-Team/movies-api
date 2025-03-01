<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\MovieResource;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function list(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $item = $request->input('item', 10);
            $keyword = $request->input('keyword', '');
    
            $data = CommonService::getModel('Movies')->getList([
                'page' => $page,
                'item' => $item,
                'keyword' => $keyword,
            ]);
    
            return $this->getListPaginate(MovieResource::collection($data));
        } catch (\Exception $e) {
            Log::error('Error in getList method', ['message' => $e->getMessage()]);
    
            return $this->sendErrorApi($e->getMessage());
        }
    }
}
