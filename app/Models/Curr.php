<?php

namespace App\Models;

/**
 * Table 'tc_curr'.
 *
 * @property integer id
 * @property string name unique
 * @property string shortcut
 * @property string full_name_1
 * @property string full_name_2
 * @property string full_name_N
 * @property string out_text
 * @property boolean status
 * @property string created_at
 * @property string updated_at
 *
 * @property ExCurr[] ex_currs
 */
class Curr extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_curr';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status', 'shortcut', 'full_name_1', 'full_name_2', 'full_name_N', 'out_text'];

    /**
     * Curr status active.
     *
     * @var boolean
     */
    public static $STATUS_ACTIVE = 1;

    /**
     * Curr status deactive.
     *
     * @var boolean
     */
    public static $STATUS_DEACTIVE = 0;

    /**
     * Return active models.
     *
     * @return Curr[]
     */
    public static function getActive() {
        return self::where('status', self::$STATUS_ACTIVE)->orderBy('name', 'asc')->get();
    }

    /**
     * Return deactive models.
     *
     * @return Curr[]
     */
    public static function getDeactive() {
        return self::where('status', self::$STATUS_DEACTIVE)->orderBy('name', 'asc')->get();
    }

    /**
     * Return deactive models.
     *
     * @return integer
     */
    public static function getDeactiveCount() {
        return self::where('status', self::$STATUS_DEACTIVE)->count();
    }

    /**
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'name' => 'required|string|min:2|max:4|unique:' . self::tableName() . ',name'
                . ($edit_id ? ',' . $edit_id : ''),
            'shortcut' => 'required|string|max:10',
            'full_name_1' => 'required|string|max:100',
            'full_name_2' => 'required|string|max:100',
            'full_name_N' => 'required|string|max:100',
            'out_text' => 'required|string|max:100'
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {
        $this->update(['status' => self::$STATUS_DEACTIVE]);

        foreach ($this->ex_currs as $ex_curr) {
            $ex_curr->update(['status' => ExCurr::$STATUS_DEACTIVE]);

            foreach ($ex_curr->currs_out as $curr_out) {
                $curr_out->update(['status' => ExCurrIn::$STATUS_DEACTIVE]);
            }

            foreach ($ex_curr->currs_in as $curr_in) {
                $curr_in->update(['status' => ExCurrIn::$STATUS_DEACTIVE]);
            }
        }
    }

    /**
     * Model relations declaration.
     */
    public function ex_currs() { return $this->hasMany('App\Models\ExCurr', 'curr_id', 'id'); }
}
