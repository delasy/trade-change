<?php

namespace App\Http\Controllers\Admin;

use App\Models\Curr;
use Illuminate\Http\Request;
use App\Models\CurrImg;
use App\Models\CurrInput;
use App\Models\ExCurr;
use App\Models\ExCurrIn;
use App\Http\Controllers\Controller;

class ExCurrController extends Controller {
    /**
     * Method that referrers to route('admin/ex-curr')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get() {
        return view('admin/ex-curr/index');
    }

    /**
     * Method that referrers to route('admin/ex-curr/add')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        return view('admin/ex-curr/add', [
            'currs' => Curr::getActive(),
            'currs_imgs' => CurrImg::getActive(),
            'currs_inputs' => CurrInput::getActive()
        ]);
    }

    /**
     * Method that referrers to route('admin/ex-curr/add') POST
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addpost(Request $request) {
        $data = $request->all();

        if (($validator = ExCurr::safeInsertCheck($data)) !== true) {
            return $this->goBack($validator);
        }

        ExCurr::safeCreate($data);

        return $this->redirectToRoute('admin/ex-curr');
    }

    /**
     * Method that referrers to url('/ex-curr/edit/{id}')
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        if (!($curr = ExCurr::safeFind($id))) {
            return $this->goBack();
        }

        return view('admin/ex-curr/edit', [
            'curr' => $curr
        ]);
    }

    /**
     * Method that referrers to url('/ex-curr/edit/{id}/deactivated')
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editdeactivated($id) {
        if (!($curr = ExCurr::safeFind($id))) {
            return $this->goBack();
        }

        return view('admin/ex-curr/edit', [
            'curr' => $curr,
            'deactive' => true
        ]);
    }

    /**
     * Method that referrers to url('/ex-curr/edit/{id}') POST
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editpost(Request $request, $id) {
        $data = $request->all();

        if (($validator = ExCurr::safeInsertCheck($data)) !== true) {
            // dd($validator->failed());
            return $this->goBack($validator);
        }

        if (ExCurr::safeFill($data, $id) === false) {
            return $this->goBack();
        }

        return $this->redirectToRoute('admin/ex-curr');
    }

    /**
     * Method that referrers to url('/ex-curr/deactivate/{id}')
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function deactivate($id) {
        if (ExCurr::safeDeactivate($id) === false) {
            return $this->goBack();
        }

        return $this->redirectToRoute('admin/ex-curr');
    }

    /**
     * Method that handles output for route('admin/ex-curr/deactivated')
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deactivated() {
        return view('admin/ex-curr/index', ['deactive' => true]);
    }

    /**
     * Method that handles output for url('admin/ex-curr/activate/{id}')
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id) {
        $curr = ExCurr::safeFind($id);
        if (!$curr) return $this->goBack();
        $curr->status = ExCurr::$STATUS_ACTIVE;
        $curr->save();

        return $this->redirectToRoute('admin/ex-curr/deactivated');
    }
}
