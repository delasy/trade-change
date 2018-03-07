<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    /**
     * Method that referrers to route('admin/index')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('admin/index', [
            'boxes' => [
                'Обменов с начала месяца<br>(ДОЛ.)' => number_format(400, 2, ',', ' '),
                'Обменов за неделю<br>(ДОЛ.)' => number_format(200, 2, ',', ' '),
                'Обменов за ' . date('Y-m-d') . '<br>(ДОЛ.)' => number_format(100, 2, ',', ' '),
                'Зарег-лось с начала месяца<br>(ЧЕЛОВЕК.)' => 400,

                'Обменов с начала месяца<br>(КОЛ-ВО.)' => 4,
                'Обменов за неделю<br>(КОЛ-ВО.)' => 2,
                'Обменов за ' . date('Y-m-d') . '<br>(КОЛ-ВО.)' => 1,
                'Зарег-лось за неделю<br>(ЧЕЛОВЕК.)' => 200,

                'Обменов с начала месяца Ср.<br>(ДОЛ.)' => number_format(400/4, 2, ',', ' '),
                'Обменов за неделю Ср.<br>(ДОЛ.)' => number_format(200/2, 2, ',', ' '),
                'Обменов за ' . date('Y-m-d') . ' Ср.<br>(ДОЛ.)' => number_format(100/1, 2, ',', ' '),
                'Зарег-лось за ' . date('Y-m-d') . '<br>(ЧЕЛОВЕК.)' => 100,
            ]
        ]);
    }
}
