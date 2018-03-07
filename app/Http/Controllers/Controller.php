<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return user backward with input, with errors or not.
     *
     * @param \Illuminate\Support\Facades\Validator|array $errors
     * @param array $input
     * @return RedirectResponse
     */
    public function goBack($errors = null, $input = null) {
        $return = back();

        if ($errors !== null) {
            $return = $return->withErrors($errors);
        }

        $return = $return->withInput($input);

        return $return;
    }

    /**
     * Move user page to specified route.
     *
     * @param string $route
     * @param \Illuminate\Support\Facades\Validator|array $errors
     * @param array $input
     * @return RedirectResponse
     */
    public function redirectToRoute($route, $errors = null, $input = null) {
        $return = redirect()->route($route);

        if ($errors !== null) {
            $return = $return->withErrors($errors);
        }

        $return = $return->withInput($input);

        return $return;
    }

    /**
     * Move user page to specified url.
     *
     * @param string $url
     * @param \Illuminate\Support\Facades\Validator|array $errors
     * @param array $input
     * @return RedirectResponse
     */
    public function redirectToUrl($url, $errors = null, $input = null) {
        $return = redirect()->to($url);

        if ($errors !== null) {
            $return = $return->withErrors($errors);
        }

        $return = $return->withInput($input);

        return $return;
    }
}
