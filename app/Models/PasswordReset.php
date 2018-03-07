<?php

namespace App\Models;

/**
 * Table 'tc_password_reset'.
 *
 * @property integer id
 * @property string email unique
 * @property string token
 * @property string created_at
 */
class PasswordReset extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_password_reset';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token', 'email'];

    /**
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return void
     */
    public static function getRules($edit_id = 0) {}

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {}
}
