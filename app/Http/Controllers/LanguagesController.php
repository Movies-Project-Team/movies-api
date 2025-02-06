<?php

namespace App\Http\Controllers;

use App\Services\CommonService;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Get List Languages
     */
    public function getListLanguages()
    {
        try {
            $languages = CommonService::getModel('Languages')->getList();
            return $this->sendResponseApi(['data' => $languages, 'code' => 200]);
        } catch (\Exception $e) {
            return $this->sendResponseApi(['error' => $e->getMessage(), 'code' => 500]);
        }
    }

}
