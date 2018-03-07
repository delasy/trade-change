<?php

namespace App\Http\Controllers\Admin;

use App\Models\CurrInput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrInputController extends Controller {
    /**
     * Method that referrers to route('admin/curr-input')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get() {
        return view('admin/curr-input/index', [
            'curr_inputs' => CurrInput::getActive()
        ]);
    }

    /**
     * Method that referrers to route('admin/curr-input/add')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        return view('admin/curr-input/add');
    }

    /**
     * Method that referrers to route('admin/curr-input/add') of POST method
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function addpost(Request $request) {
        $data = $request->all();

        if (($validator = CurrInput::safeInsertCheck($data)) !== true) {
            return $this->goBack($validator);
        }

        CurrInput::safeCreate($data);

        return $this->redirectToRoute('admin/curr-input');
    }

    /**
     * Method that referrers to url('admin/curr-input/look/{id}')
     *
     * @param string $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function look($id) {
        if (!($curr_input = CurrInput::safeFind($id))) {
            return $this->goBack();
        }

        return view('admin/curr-input/look', [
            'curr_input' => $curr_input
        ]);
    }
}
