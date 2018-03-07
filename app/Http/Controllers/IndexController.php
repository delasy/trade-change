<?php

namespace App\Http\Controllers;

use App\Models\ExCurr;
use App\Models\ExCurrIn;
use App\Models\ExOrder;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller {
    /**
     * Method that referrers to route('index')
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function get(Request $request) {
        $step = 1;
        $ex_order = self::checkOrderExists($request);

        if (!empty($ex_currs = $this->checkOutInExists($request))) {
            $data = $this->step2($ex_currs['out'], $ex_currs['in']);
            $step = 2;
        } elseif ($ex_order !== false && $request->has('pay')) {
            // TODO check if order in need state for pay
            $step = 3;
            $data = [];
            $data['ex_order'] = $ex_order;
        } elseif ($ex_order !== false) {
            // TODO check if order in need state to be viewed
            $step = 3;
            $data = [];
            $data['ex_order'] = $ex_order;
            $data['with_ex_order'] = true;
            $data['ex_order_sha256'] = AppHelper::encodeExOrder($ex_order->id, Auth::user()->{'id'});
        } else {
            $data = $this->step1();
        }

        $data['step'] = $step;

        return view('index-old', $data);
    }

    /**
     * Method that referrers to route('exchange') POST
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function post(Request $request) {
        if (empty($ex_currs = $this->checkOutInExists($request))) {
            return $this->get($request);
        }

        /** @var ExCurr $ex_curr_out */
        $ex_curr_out = $ex_currs['out'];
        /** @var ExCurr $ex_curr_in */
        $ex_curr_in = $ex_currs['in'];
        $redirect_url = '/exchange?out=' . $ex_curr_out->id . '&in=' . $ex_curr_in->id;
        $data = $request->all();
        $data['in_amount'] = trim($data['in_amount']);
        $data['out_amount'] = trim($data['out_amount']);

        $rules = [
            'out_amount' => 'required|numeric|min:' . $ex_curr_out->min_val . '|max:' . $ex_curr_out->max_val,
            'in_amount' => 'required|numeric|min:' . $ex_curr_in->min_val . '|max:' .
                (
                    floatval($ex_curr_in->max_val) > floatval($ex_curr_in->reserve)
                    ? $ex_curr_in->reserve
                    : $ex_curr_in->max_val
                ),
            'user_email' => 'required|string|email|max:255',
            'user_phone' => 'required|string|is_phone|max:20'
        ];

        for ($i = 1; $i < count($ex_curr_out->fields()) + 1; $i++) {
            $rules['ex_curr_out_field' . $i] = 'required|string';
        }

        for ($i = 1; $i < count($ex_curr_in->fields()) + 1; $i++) {
            $rules['ex_curr_in_field' . $i] = 'required|string';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->redirectToUrl($redirect_url, $validator);
        }

        $in_in_rate = floatval($ex_curr_in->ex_in_rate);
        $out_out_rate = floatval($ex_curr_out->ex_out_rate);
        $delta = $out_out_rate / $in_in_rate;
        $result = (floatval($data['out_amount']) === 0 ? 0 : floatval($data['out_amount']) ) * $delta;
        $result = floatval(number_format(100 * $result / 99, $ex_curr_in->ch_after_point, '.', ''));

        if (floatval($data['in_amount']) !== $result) {
            return $this->redirectToUrl($redirect_url, ['in_amount' => 'In amount is wrong.']);
        }

        if (!Auth::check()) {
            $password = AppHelper::generatePassword(10, false, 'lud');
            $user_data = [
                'email' => $data['user_email'],
                'name' => substr($data['user_email'], 0, strpos($data['user_email'], '@')),
                'password' => $password,
                'password_confirmation' => $password
            ];

            if (($validator = SignupController::registerUser($user_data)) !== true) {
                return $this->redirectToUrl($redirect_url, $validator);
            }

            if (!Auth::check()) {
                return $this->redirectToUrl($redirect_url, ['auth' => 'Cannot authorize your email']);
            }

            $user_id = Auth::user()->{'id'};
        } else {
            $user_id = Auth::user()->{'id'};
        }

        $ex_order_data = [
            'ex_curr_in_id' => $ex_curr_in->id,
            'ex_curr_out_id' => $ex_curr_out->id,
            'ex_curr_in_sum' => number_format($data['in_amount'], $ex_curr_in->ch_after_point, '.', ''),
            'ex_curr_out_sum' => number_format($data['out_amount'], $ex_curr_out->ch_after_point, '.', ''),
            'user_id' => $user_id,
            'user_email' => $data['user_email'],
            'user_phone' => $data['user_phone']
        ];

        for ($i = 1; $i < count($ex_curr_out->fields()) + 1; $i++) {
            $ex_order_data['ex_curr_out_field' . $i] = $data['ex_curr_out_field' . $i];
        }

        for ($i = 1; $i < count($ex_curr_in->fields()) + 1; $i++) {
            $ex_order_data['ex_curr_in_field' . $i] = $data['ex_curr_in_field' . $i];
        }

        if (($validator = ExOrder::safeInsertCheck($ex_order_data)) !== true) {
            return $this->redirectToUrl($redirect_url, $validator);
        }

        try {
            $ex_order = ExOrder::safeCreate($ex_order_data);
        } catch (\Exception $e) {
            return $this->redirectToUrl(
                $redirect_url,
                ['order' => ['Cannot create order for your request.<br>Please try again at 3 minutes.']]
            );
        }

        AppHelper::sendTelegramMessage(
            'Новый обмен валюты на сайте trade-change.com' . PHP_EOL
            . 'Продажа: <b>' . $ex_curr_out->name . ' ' . $ex_curr_out->curr->name . '</b>' . PHP_EOL
            . 'Сумма продажи: <b>' . $data['out_amount'] . '</b>' . PHP_EOL
            . 'Покупка: <b>' . $ex_curr_in->name . ' ' . $ex_curr_in->curr->name . '</b>' . PHP_EOL
            . 'Сумма продажи: <b>' . $data['in_amount'] . '</b>' . PHP_EOL
            . '<a href="' . url('/admin/ex_order/' . 1) . '">Ссылка на заявку</a>'
        );

        return $this->redirectToUrl('/exchange?order_id=' . $ex_order->id);
    }

    /**
     * Check if echange-out and exchange-in exists.
     *
     * @param Request $request
     * @return array
     */
    private function checkOutInExists(Request $request) {
        $curr_out = ($request->has('out') && $request->input('out')
            && ExCurr::safeFind($request->input('out'))) ? intval($request->input('out')) : 0;
        $curr_in = ($request->has('out') && $request->input('in')
            && ExCurr::safeFind($request->input('in'))) ? intval($request->input('in')) : 0;

        if ($curr_out !== 0 && $curr_in !== 0) {
            return ['out' => ExCurr::safeFind($curr_out), 'in' => ExCurr::safeFind($curr_in)];
        } else {
            return [];
        }
    }

    /**
     * Check if echange-out and exchange-in exists.
     * Used by \App\Http\Controllers\Api\V1\OrderStatusController
     *
     * @param Request $request
     * @param bool $with_auth
     * @return ExOrder|boolean
     */
    public static function checkOrderExists(Request $request, $with_auth = true) {
        if (!Auth::check() && $with_auth) return false;

        if ($with_auth) {
            $ex_order_id = (
                $request->has('order_id')
                && $request->input('order_id')
                && ExOrder::where([
                    ['id', '=', $request->input('order_id')],
                    ['user_id', '=', Auth::user()->{'id'}]
                ])->first()
            ) ? intval($request->input('order_id')) : 0;
        } else {
            $ex_order_id = (
                $request->has('order_id')
                && $request->input('order_id')
                && ExOrder::where('id', $request->input('order_id'))->first()
            ) ? intval($request->input('order_id')) : 0;
        }

        return ($ex_order_id !== 0) ? ExOrder::safeFind($ex_order_id) : false;
    }

    /**
     * Method that builds data for first step.
     *
     * @return array
     */
    private function step1() {
        $data = [];
        $data['ex_currs'] = [];
        foreach (ExCurr::getActive() as $ex_curr_out) {
            $ex_currs_in = [];

            foreach (ExCurrIn::getActive($ex_curr_out->id) as $ex_curr_in) {
                $ex_currs_in[] = [
                    'id' => $ex_curr_in->ex_curr_in->id,
                    'name' => $ex_curr_in->ex_curr_in->name,
                    'curr_name' => $ex_curr_in->ex_curr_in->curr->name,
                    'full_name' => $ex_curr_in->ex_curr_in->name . ' ' . $ex_curr_in->ex_curr_in->curr->name,
                    'img' => $ex_curr_in->ex_curr_in->img->getPath(),
                    'reserve' => number_format(
                        $ex_curr_in->ex_curr_in->reserve, $ex_curr_in->ex_curr_in->ch_after_point, '.', ' '
                    )
                ];
            }

            if (empty($ex_currs_in)) continue;

            $data['ex_currs'][] = [
                'id' => $ex_curr_out->id,
                'name' => $ex_curr_out->name,
                'curr_name' => $ex_curr_out->curr->name,
                'full_name' => $ex_curr_out->name . ' ' . $ex_curr_out->curr->name,
                'img' => $ex_curr_out->img->getPath(),
                'currs_in' => $ex_currs_in,
                'reserve' => number_format($ex_curr_out->reserve, $ex_curr_out->ch_after_point, '.', ' ')
            ];
        }

        $data['ex_currs_json'] = [];
        $data['first_ex_curr'] = 0;

        foreach ($data['ex_currs'] as $ex_curr) {
            if (!$data['first_ex_curr']) {
                $data['first_ex_curr'] = $ex_curr['id'];
            }

            $data['ex_currs_json'][$ex_curr['id']] = $ex_curr['currs_in'];
        }

        return $data;
    }

    /**
     * Method that builds data for second step.
     *
     * @param ExCurr $curr_out
     * @param ExCurr $curr_in
     * @return array
     */
    private function step2(ExCurr $curr_out, ExCurr $curr_in) {
        $data = [];
        $data['curr_out'] = $curr_out;
        $data['curr_in'] = $curr_in;
        $data['currs_json'] = [
            'out' => [
                'min_val' => $curr_out->min_val,
                'reserve' => $curr_out->reserve,
                'ex_out_rate' => $curr_out->ex_out_rate,
                'ch_after_point' => $curr_out->ch_after_point
            ],
            'in' => [
                'min_val' => $curr_in->min_val,
                'reserve' => $curr_in->reserve,
                'ex_in_rate' => $curr_in->ex_in_rate,
                'ch_after_point' => $curr_in->ch_after_point
            ]
        ];
        return $data;
    }

    /**
     * Method that builds data for third step.
     *
     * @return array
     */
    private function step3() {
        $data = [];
        $data['step'] = 3;

        return $data;
    }
}
