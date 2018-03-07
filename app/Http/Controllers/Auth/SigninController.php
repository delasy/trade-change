<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SigninController extends Controller {
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account/';

    /**
     * Method that referrers to route('auth/signin')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('auth/signin-old');
    }

    /**
     * Method that referrers to route('auth/signin') of POST method
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function post(Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
            return false;
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->redirectToRoute(
            'auth/signin',
            [$this->username() => [trans('auth.failed')]],
            $request->only($this->username(), 'remember')
        );
    }
}
