<?php

namespace App\Http\Controllers;

class AboutServiceController extends Controller {
    /**
     * Method that referrers to route('terms-of-service')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('about-service-old');
    }
}
