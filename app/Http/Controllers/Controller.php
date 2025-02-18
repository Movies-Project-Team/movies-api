<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponseApi($params = []) {
        $params = array_merge([
            'code' => Response::HTTP_OK,
            'message' => null,
            'data' => null,
        ], $params);

        $responseMessages = [
            Response::HTTP_OK => 'Success',
            Response::HTTP_BAD_REQUEST => 'Invalid Parameters',
            Response::HTTP_UNAUTHORIZED => 'Unauthorized',
            Response::HTTP_FORBIDDEN => 'Forbidden',
            Response::HTTP_NOT_FOUND => 'Page Not Found',
            Response::HTTP_TOO_MANY_REQUESTS => 'Too Many Attempts',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
            Response::HTTP_SERVICE_UNAVAILABLE => 'Service Unavailable',
        ];

        $params['message'] = $params['message'] ?? ($responseMessages[$params['code']] ?? 'Unknown Status');

        if ($params['code'] === Response::HTTP_OK) {
            unset($params['errors']);
        } else {
            unset($params['data']);
        }

        return response()->json($params, $params['code']);
    }
}
