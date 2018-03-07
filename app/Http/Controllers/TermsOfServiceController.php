<?php

namespace App\Http\Controllers;

class TermsOfServiceController extends Controller {
    /**
     * Method that referrers to route('terms-of-service')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('terms-of-service-old', [
            'tos_content' => str_replace(
                "\n",
                '<br>',
                @file_get_contents(storage_path('backup/terms-of-service/current.txt'), TRUE)
            )
        ]);
    }
}
