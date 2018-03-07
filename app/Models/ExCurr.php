<?php

namespace App\Models;

/**
 * Table 'tc_ex_curr'.
 *
 * @property integer id
 * @property string name tipple_unique
 * @property integer curr_id tipple_unique
 * @property integer curr_img_id tipple_unique
 * @property boolean status
 * @property double min_val
 * @property double max_val
 * @property double reserve
 * @property double ex_out_rate
 * @property double ex_in_rate
 * @property integer ch_after_point
 * @property integer field1_id
 * @property integer field2_id
 * @property integer field3_id
 * @property integer field4_id
 * @property string created_at
 * @property string updated_at
 *
 * @property Curr curr
 * @property CurrImg img
 * @property ExCurr[] currs_out
 * @property ExCurr[] currs_in
 * @property CurrInput field1
 * @property CurrInput field2
 * @property CurrInput field3
 * @property CurrInput field4
 */
class ExCurr extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_ex_curr';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'curr_id', 'curr_img_id', 'status', 'min_val', 'max_val', 'reserve', 'ex_out_rate', 'ex_in_rate',
        'ch_after_point', 'field1_id', 'field2_id', 'field3_id', 'field4_id'
    ];

    /**
     * ExCurr status active.
     *
     * @var boolean
     */
    public static $STATUS_ACTIVE = 1;

    /**
     * ExCurr status deactive.
     *
     * @var boolean
     */
    public static $STATUS_DEACTIVE = 0;

    /**
     * Return active models.
     *
     * @param int $where_not
     * @return ExCurr[]
     */
    public static function getActive($where_not = 0) {
        $stn = self::tableName(); // sortcut of 'self table name'
        $query = self::where($stn . '.status', self::$STATUS_ACTIVE);

        if ($where_not !== 0) {
            $query->where($stn. '.id', '!=', $where_not)
                ->whereNotIn($stn . '.id', function ($qry) use ($where_not) {
                    $qry->select('ex_curr_in_id')
                        ->from(ExCurrIn::tableName())
                        ->where('ex_curr_out_id', '=', $where_not)
                        ->where('status', '=', ExCurrIn::$STATUS_ACTIVE);
                });
        }

        $query->join(Curr::tableName() . ' as cu', 'cu.id', '=', $stn . '.curr_id');
        $query->select($stn . '.*');
        $query->orderBy($stn . '.name', 'asc')->orderBy('cu.name', 'asc');

        return $query->get();
    }

    /**
     * Return deactive models.
     *
     * @return ExCurr[]
     */
    public static function getDeactive() {
        $stn = self::tableName(); // sortcut of 'self table name'
        $query = self::where($stn . '.status', self::$STATUS_DEACTIVE);
        $query->join(Curr::tableName() . ' as cu', 'cu.id', '=', $stn . '.curr_id');
        $query->select($stn . '.*');
        $query->orderBy($stn . '.name', 'asc')->orderBy('cu.name', 'asc');

        return $query->get();
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
            'name' => 'required|string|max:50',
            'curr_id' => 'required|int|exists:' . Curr::tableName() . ',id',
            'curr_img_id' => 'required|int|exists:' . CurrImg::tableName() . ',id',
            'min_val' => 'required|numeric',
            'max_val' => 'required|numeric',
            'reserve' => 'required|numeric',
            'status' => 'nullable|boolean',
            'ex_out_rate' => 'required|numeric',
            'ex_in_rate' => 'required|numeric',
            'ch_after_point' => 'required|int|min:0|max:4',
            'field1_id' => 'nullable|int|exists:' . CurrInput::tableName() . ',id',
            'field2_id' => 'nullable|int|exists:' . CurrInput::tableName() . ',id',
            'field3_id' => 'nullable|int|exists:' . CurrInput::tableName() . ',id',
            'field4_id' => 'nullable|int|exists:' . CurrInput::tableName() . ',id'
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {
        $this->update(['status' => self::$STATUS_DEACTIVE]);

        foreach ($this->currs_out as $curr_out) {
            $curr_out->update(['status' => ExCurrIn::$STATUS_DEACTIVE]);
        }

        foreach ($this->currs_in as $curr_in) {
            $curr_in->update(['status' => ExCurrIn::$STATUS_DEACTIVE]);
        }
    }

    /**
     * Calculates total service reserves.
     *
     * @return string
     */
    public static function getReserves() {
        $result = self::where('status', ExCurr::$STATUS_ACTIVE)
            ->selectRaw('sum(reserve * ex_out_rate) as reserves')
            ->first();

        $reserves = (intval($result->reserves) + 1) . '';
        if (strlen($reserves) > 3) {
            $reserves = (intval(substr($reserves, 0, -3)) + 1) . '';

            if (strlen($reserves) > 3) {
                $reserves = (intval(substr($reserves, 0, -3)) + 1) . '';

                if (strlen($reserves) > 3) {
                    $reserves = (intval(substr($reserves, 0, -3)) + 1) . 'KKK';
                } else {
                    $reserves .= 'KK';
                }
            } else {
                $reserves .= 'K';
            }
        }

        return $reserves . '$';
    }

    /**
     * Return model possible fields as array.
     *
     * @return array
     */
    public function fields() {
        $fields = [];

        for ($i = 1; $i < 5; $i++) {
            if ($this->{'field' . $i . '_id'} !== NULL) {
                $fields[] = $this->{'field' . $i};
            } else {
                break;
            }
        }

        return $fields;
    }

    /**
     * Model relations declaration.
     */
    public function curr() { return $this->hasOne('App\Models\Curr', 'id', 'curr_id'); }
    public function img() { return $this->hasOne('App\Models\CurrImg', 'id', 'curr_img_id'); }
    public function currs_out() { return $this->hasMany('App\Models\ExCurrIn', 'ex_curr_in_id', 'id'); }
    public function currs_in() { return $this->hasMany('App\Models\ExCurrIn', 'ex_curr_out_id', 'id'); }
    public function field1() { return $this->hasOne('App\Models\CurrInput', 'id', 'field1_id'); }
    public function field2() { return $this->hasOne('App\Models\CurrInput', 'id', 'field2_id'); }
    public function field3() { return $this->hasOne('App\Models\CurrInput', 'id', 'field3_id'); }
    public function field4() { return $this->hasOne('App\Models\CurrInput', 'id', 'field4_id'); }
}
