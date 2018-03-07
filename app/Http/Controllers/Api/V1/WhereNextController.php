<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhereNextController extends Controller {
    /**
     * Method that referrers to route('api/v1/where-next')
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request) {
        $data = [];
        $route = strval($request->input('route'));

        switch ($route) {
            case '/': $data['next'] = 'Index'; break;
            default: $data['next'] = 'Error';
        }

        return response()->json($data);
    }
}
