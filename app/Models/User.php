<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Table 'tc_user'.
 *
 * @property integer id
 * @property string name
 * @property string email unique
 * @property string password
 * @property string remember_token
 * @property string created_at
 * @property string updated_at
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . self::tableName() . ',email'
                . (!$edit_id ? '' : ',' . $edit_id),
            'password' => 'required|string|min:6|max:255|confirmed',
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {}
}
