<?php

namespace App\Http\Controllers;

use App\Services\CommonService;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Get List Genres
     */
    public function getListGenres()
    {
        try {
            $genres = CommonService::getModel('Genres')->getList();
            return $this->sendResponseApi(['data' => $genres, 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }
}
