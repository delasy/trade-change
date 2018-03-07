<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ExOrder;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IndexController;

class OrderStatusController extends Controller {
    /**
     * Method that handles output for view.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function post(Request $request) {
        $response_wait = ['status' => 'wait', 'message' => 'Your order is not processed yet.'];
        $response_success = ['status' => true, 'message' => 'Your order ready to be payed.'];

        $order_hash = $request->has('order_hash') && $request->input('order_hash')
            ? strval($request->input('order_hash')) : '';

        if ($order_hash === '') {
            return $this->respondError('Order hash not specified.');
        }

        if (($ex_order = IndexController::checkOrderExists($request, false)) === false) {
            return $this->respondError('Order does not exists.');
        }

        $order_hash_real = AppHelper::encodeExOrder($ex_order->id, $ex_order->user_id);

        if ($order_hash_real !== $order_hash) {
            return $this->respondError('Order hash is wrong.');
        }

        if (intval($ex_order->status) === ExOrder::$STATUS_ACTIVE) {
            return response()->json($response_wait);
        }

        return response()->json($response_success);
    }

    /**
     * Generated ouput for error response
     *
     * @param string $error_text
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondError($error_text = null) {
        $error_text = $error_text === null ? 'You have errors in your request.' : $error_text;
        $data = [];
        $data['message'] = $error_text;
        $data['status'] = false;

        return response()->json(json_encode($data));
    }
}
