<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponseApi($params) {
        $params = array_merge([
            'code' => Response::HTTP_OK,
            'data' => null,
            'errors' => null,
        ], $params);

        $arrMessage = [
            Response::HTTP_OK => 'Success',
            Response::HTTP_BAD_REQUEST => 'Invalid Parameters',
            Response::HTTP_UNAUTHORIZED => 'Unauthorized',
            Response::HTTP_FORBIDDEN => 'Forbidden',
            Response::HTTP_NOT_FOUND => 'Page Not Found',
            Response::HTTP_TOO_MANY_REQUESTS => 'Too Many Attempts',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
            Response::HTTP_SERVICE_UNAVAILABLE => 'Service Unavailable',
        ];

        $return = [
            'message' => $arrMessage[$params['code']],
        ];
        if ($params['data']) {
            $return['data'] = $params['data'];
        }
        if ($params['errors']) {
            $return['errors'] = $params['errors'];
        }

        unset($params['errors']);
        
        return response()->json(array_merge($return, $params));
    }
}
