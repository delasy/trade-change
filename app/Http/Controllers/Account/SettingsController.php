<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class SettingsController extends Controller {
    /**
     * Method that referrers to route('account/settings')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('account/settings-old', [
            'settings_active' => ' selected'
        ]);
    }
}
