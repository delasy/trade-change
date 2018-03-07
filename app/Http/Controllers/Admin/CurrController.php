<?php

namespace App\Http\Controllers\Admin;

use App\Models\Curr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrController extends Controller {
    /**
     * Method that referrers to route('admin/currency')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get() {
        return view('admin/curr/index');
    }

    /**
     * Method that referrers to route('admin/currency-add')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        return view('admin/curr/add');
    }

    /**
     * Method that referrers to route('admin/currency-add') of POST method
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addpost(Request $request) {
        $data = $request->all();

        if (($validator = Curr::safeInsertCheck($data)) !== true) {
            return $this->goBack($validator);
        }

        Curr::safeCreate($data);

        return $this->redirectToRoute('admin/curr');
    }

    /**
     * Method that referrers to url('/currency/edit/{id}')
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        if (!($curr = Curr::safeFind($id))) {
            return $this->goBack();
        }

        return view('admin/curr/edit', [
            'curr' => $curr
        ]);
    }

    /**
     * Method that referrers to url('/currency/edit/{id}') of POST method
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editpost(Request $request, $id) {
        $data = $request->all();

        if (($validator = Curr::safeInsertCheck($data, $id)) !== true) {
            return $this->goBack($validator);
        }

        if (Curr::safeFill($data, $id) === false) {
            return $this->goBack();
        }

        return $this->redirectToRoute('admin/curr');
    }

    /**
     * Method that referrers to url('/currency/deactivate/{id}') of POST method
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function deactivate($id) {
        if (Curr::safeDeactivate($id) === false) {
            return $this->goBack();
        }

        return $this->redirectToRoute('admin/curr');
    }

    /**
     * Method that handles output for route('admin/curr/deactivated')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deactivated() {
        return view('admin/curr/index', ['deactive' => true]);
    }

    /**
     * Method that handles output for url('admin/curr/activate/{id}')
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id) {
        $curr = Curr::safeFind($id);
        if (!$curr) return $this->goBack();
        $curr->status = Curr::$STATUS_ACTIVE;
        $curr->save();

        return $this->redirectToRoute('admin/curr/deactivated');
    }
}
