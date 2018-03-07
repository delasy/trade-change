<?php

namespace App\Models;

/**
 * Table 'tc_ex_curr_in'.
 *
 * @property integer id
 * @property integer ex_curr_out_id double_unique
 * @property integer ex_curr_in_id double_unique
 * @property boolean status
 * @property string created_at
 * @property string updated_at
 *
 * @property ExCurr ex_curr_out
 * @property ExCurr ex_curr_in
 */
class ExCurrIn extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_ex_curr_in';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ex_curr_out_id', 'ex_curr_in_id', 'status'];

    /**
     * ExCurrIn status active.
     *
     * @var boolean
     */
    public static $STATUS_ACTIVE = 1;

    /**
     * ExCurrIn status deactive.
     *
     * @var boolean
     */
    public static $STATUS_DEACTIVE = 0;

    /**
     * Return active models.
     *
     * @param $id
     * @return ExCurrIn[]
     */
    public static function getActive($id) {
        return self::join(ExCurr::tableName() . ' as ce', 'ce.id', '=', self::tableName() . '.ex_curr_in_id')
            ->join(Curr::tableName() . ' as cu', 'cu.id', '=', 'ce.curr_id')
            ->where([
                [self::tableName() . '.ex_curr_out_id', '=', $id],
                [self::tableName() . '.status', '=', self::$STATUS_ACTIVE],
            ])
            ->select(self::tableName() . '.*')
            ->orderBy('ce.name', 'asc')
            ->orderBy('cu.name', 'asc')
            ->get();
    }

    /**
     * Return deactive models.
     *
     * @param $id
     * @return ExCurrIn[]
     */
    public static function getDeactive($id) {
        return self::join(ExCurr::tableName() . ' as ce', 'ce.id', '=', self::tableName() . '.ex_curr_in_id')
            ->join(Curr::tableName() . ' as cu', 'cu.id', '=', 'ce.curr_id')
            ->where([
                [self::tableName() . '.ex_curr_out_id', '=', $id],
                [self::tableName() . '.status', '=', self::$STATUS_DEACTIVE],
            ])
            ->select(self::tableName() . '.*')
            ->orderBy('ce.name', 'asc')
            ->orderBy('cu.name', 'asc')
            ->get();
    }

    /**
     * Return deactive models count.
     *
     * @param integer $curr_out
     * @return integer
     */
    public static function getDeactiveCount($curr_out) {
        return self::where([
            ['ex_curr_out_id', '=', $curr_out],
            ['status', '=', self::$STATUS_DEACTIVE],
        ])->count();
    }

    /**
     * Return any models count.
     *
     * @param integer $curr_out
     * @return integer
     */
    public static function getAnyCount($curr_out) {
        return self::where('ex_curr_out_id', $curr_out)->count();
    }

    /**
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'ex_curr_out_id' => 'required|int|exists:' . ExCurr::tableName() . ',id',
            'ex_curr_in_id' => 'required|int|exists:' . ExCurr::tableName() . ',id'
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {
        $this->update(['status' => self::$STATUS_DEACTIVE]);
    }

    /**
     * Model relations declaration.
     */
    public function ex_curr_out() { return $this->hasOne('App\Models\ExCurr', 'id', 'ex_curr_out_id'); }
    public function ex_curr_in() { return $this->hasOne('App\Models\ExCurr', 'id', 'ex_curr_in_id'); }
}
