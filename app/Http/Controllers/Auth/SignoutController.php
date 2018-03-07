<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;

class SignoutController extends Controller {
    use AuthenticatesUsers;

    /**
     * Method that referrers to route('auth/signout')
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function get(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->redirectToUrl('/');
    }
}
