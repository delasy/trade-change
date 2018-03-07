<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ExCurr;
use App\Models\ExCurrIn;
use App\Http\Controllers\Controller;

class ExCurrInController extends Controller {
    /**
     * Method that referrers to url('/ex-curr/in/add/{id}')
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add($id) {
        return view('admin/ex-curr-in/add', [
            'ex_currs' => ExCurr::getActive($id)
        ]);
    }

    /**
     * Method that referrers to url('/ex-curr/in/add/{id}') POST
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addpost(Request $request, $id) {
        $data = $request->all();
        $data['ex_curr_out_id'] = $id;

        if (($validator = ExCurrIn::safeInsertCheck($data)) !== true) {
            return $this->goBack($validator);
        }

        ExCurrIn::updateOrCreate([
            'ex_curr_in_id' => $data['ex_curr_in_id'],
            'ex_curr_out_id' => $data['ex_curr_out_id']
        ], [
            'status' => ExCurrIn::$STATUS_ACTIVE
        ]);

        return $this->redirectToUrl('/admin/ex-curr/edit/' . $id);
    }

    /**
     * Method that referrers to url('/ex-curr/in/add-all/{id}')
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add_all($id) {
        if (!ExCurr::where([['id', +$id], ['status', ExCurr::$STATUS_ACTIVE]])->first()) {
            return $this->redirectToUrl('/admin/ex-curr/edit/' . $id);
        }

        foreach (ExCurr::getActive($id) as $ex_curr_in) {
            ExCurrIn::updateOrCreate([
                'ex_curr_in_id' => intval($ex_curr_in->id),
                'ex_curr_out_id' => $id
            ], [
                'status' => ExCurrIn::$STATUS_ACTIVE
            ]);
        }

        return $this->redirectToUrl('/admin/ex-curr/edit/' . $id);
    }

    /**
     * Method that referrers to url('/ex-curr/in/add/{id}')
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deactivate($id) {
        if (($curr_in = ExCurrIn::safeDeactivate($id)) === false) {
            return $this->goBack();
        }

        return $this->redirectToUrl('/admin/ex-curr/edit/' . $curr_in->ex_curr_out_id);
    }

    /**
     * Method that referrers to url('/ex-curr/in/add/{id}')
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activate($id) {
        $curr_in = ExCurrIn::safeFind($id);
        if (!$curr_in) return $this->goBack();
        $curr_in->status = ExCurr::$STATUS_ACTIVE;
        $curr_in->save();

        return $this->redirectToUrl('/admin/ex-curr/edit/' . $curr_in->ex_curr_out_id . '/deactivated#ex_currs_in');
    }
}
