<?php

namespace App\Models;

/**
 * Table 'tc_curr_img'.
 *
 * @property integer id
 * @property string name unique
 */
class CurrImg extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_curr_img';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Array of all currently available images to be stored in DB by php artisan db:seed
     *
     * @var array
     */
    public static $ALL_IMAGES = [
        ['name' => 'advcash'],
        ['name' => 'bitcoin-cash'],
        ['name' => 'bitcoin'],
        ['name' => 'dash'],
        ['name' => 'ethereum'],
        ['name' => 'exmo'],
        ['name' => 'litecoin'],
        ['name' => 'monero'],
        ['name' => 'payeer'],
        ['name' => 'perfect-money'],
        ['name' => 'privat24'],
        ['name' => 'qiwi'],
        ['name' => 'ripple'],
        ['name' => 'sberbank'],
        ['name' => 'tinkoff'],
        ['name' => 'vtb24'],
        ['name' => 'yandex-money'],
        ['name' => 'zcash']
    ];

    /**
     * Return active models.
     *
     * @return mixed
     */
    public static function getActive() {
        return self::orderBy('name', 'asc')->get();
    }

    /**
     * Return web path to currency image.
     *
     * @return string
     */
    public function getPath() {
        return '/images/currency/' . $this->name . '.svg';
    }

    /**
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'name' => 'required|string|max:255|unique:' . self::tableName() . ',name'
                . (!$edit_id ? '' : ',' . $edit_id)
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {}
}
