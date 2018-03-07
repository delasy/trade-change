<?php

namespace App\Models;

/**
 * Table 'tc_ex_order'.
 *
 * @property integer id
 * @property integer ex_curr_in_id
 * @property integer ex_curr_out_id
 * @property double ex_curr_in_sum
 * @property double ex_curr_out_sum
 * @property integer user_id
 * @property string user_email
 * @property string user_phone
 * @property integer status
 * @property integer ex_curr_in_field1
 * @property integer ex_curr_in_field2
 * @property integer ex_curr_in_field3
 * @property integer ex_curr_in_field4
 * @property integer ex_curr_out_field1
 * @property integer ex_curr_out_field2
 * @property integer ex_curr_out_field3
 * @property integer ex_curr_out_field4
 * @property string created_at
 * @property string updated_at
 *
 * @property ExCurr ex_curr_in
 * @property ExCurr ex_curr_out
 * @property User user
 */
class ExOrder extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_ex_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ex_curr_in_id', 'ex_curr_out_id', 'ex_curr_in_sum', 'ex_curr_out_sum', 'user_id', 'user_email', 'user_phone',
        'status', 'ex_curr_in_field1', 'ex_curr_in_field2', 'ex_curr_in_field3', 'ex_curr_in_field4',
        'ex_curr_out_field1', 'ex_curr_out_field2', 'ex_curr_out_field3', 'ex_curr_out_field4'
    ];

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
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'ex_curr_in_id' => 'required|int|min:1|exists:' . ExCurr::tableName() . ',id',
            'ex_curr_out_id' => 'required|int|min:1|exists:' . ExCurr::tableName() . ',id',
            'ex_curr_in_sum' => 'required|numeric',
            'ex_curr_out_sum' => 'required|numeric',
            'user_id' => 'required|int|min:1|exists:' . User::tableName() . ',id',
            'user_email' => 'required|string|min:1|max:255',
            'user_phone' => 'required|string|min:1|max:20',
            'status' => 'nullable|int|min:0|max:1',
            'ex_curr_in_field1' => 'nullable|string',
            'ex_curr_in_field2' => 'nullable|string',
            'ex_curr_in_field3' => 'nullable|string',
            'ex_curr_in_field4' => 'nullable|string',
            'ex_curr_out_field1' => 'nullable|string',
            'ex_curr_out_field2' => 'nullable|string',
            'ex_curr_out_field3' => 'nullable|string',
            'ex_curr_out_field4' => 'nullable|string',
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
     * Return model possible ex_curr_in_fields as array.
     *
     * @return array
     */
    public function ex_curr_in_fields() {
        $fields = [];

        for ($i = 1; $i < 5; $i++) {
            if ($this->{'ex_curr_in_field' . $i} !== NULL) {
                $fields[] = $this->{'ex_curr_in_field' . $i};
            }
        }

        return $fields;
    }

    /**
     * Return model possible ex_curr_out_fields as array.
     *
     * @return array
     */
    public function ex_curr_out_fields() {
        $fields = [];

        for ($i = 1; $i < 5; $i++) {
            if ($this->{'ex_curr_out_field' . $i} !== NULL) {
                $fields[] = $this->{'ex_curr_out_field' . $i};
            }
        }

        return $fields;
    }

    /**
     * Model relations declaration.
     */
    public function ex_curr_in() { return $this->hasOne('App\Models\ExCurr', 'id', 'ex_curr_in_id'); }
    public function ex_curr_out() { return $this->hasOne('App\Models\ExCurr', 'id', 'ex_curr_out_id'); }
    public function user() { return $this->hasOne('App\Models\User', 'id', 'user_id'); }
}
