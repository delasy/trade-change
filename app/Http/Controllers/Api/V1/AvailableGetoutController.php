<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AvailableGetoutController extends Controller {
    /**
     * Method that referrers to route('api/v1/available-getout')
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get() {
        return response()->json([
            ['name' => 'Bitcoin', 'curr' => 'BTC', 'img' => '/bitcoin.png'],
            ['name' => 'ВТБ24', 'curr' => 'RUB', 'img' => '/bitcoin.png'],
            ['name' => 'ВТБ25', 'curr' => 'RUB', 'img' => '/bitcoin.png'],
            ['name' => 'ВТБ26', 'curr' => 'RUB', 'img' => '/bitcoin.png'],
            ['name' => 'ВТБ27', 'curr' => 'RUB', 'img' => '/bitcoin.png'],
        ]);
    }
}
