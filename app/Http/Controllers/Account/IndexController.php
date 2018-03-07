<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    /**
     * Method that referrers to route('account/index')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('account/index-old', [
            'account_active' => ' selected'
        ]);
    }
}
