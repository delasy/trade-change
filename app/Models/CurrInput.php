<?php

namespace App\Models;

/**
 * Table 'tc_curr_input'.
 *
 * @property integer id
 * @property string name unique
 * @property string html_placeholder
 */
class CurrInput extends BaseModel {
    /**
     * Defines model table name.
     *
     * @var string
     */
    protected $table = 'tc_curr_input';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'html_placeholder'];

    /**
     * Array of all currently available input to be stored in DB by php artisan db:seed
     *
     ** TIP: placeholder max length 25 symbols
     * @var array
     */
    public static $ALL_INPUTS = [
        ['name' => 'Номер карты', 'html_placeholder' => '1122 3344 5566 7788'],
        ['name' => 'Имя владельца карты', 'html_placeholder' => 'John'],
        ['name' => 'Фамилия владельца карты', 'html_placeholder' => 'Doe'],
        ['name' => 'Номер кошелька Payeer', 'html_placeholder' => 'P123456789'],
        ['name' => 'Номер кошелька PM', 'html_placeholder' => 'U123456789'],
        ['name' => 'Номер кошелька Яндекс', 'html_placeholder' => '112233445566778'],
        ['name' => 'Номер кошелька Qiwi', 'html_placeholder' => '+79012345678'],
        ['name' => 'Адрес Bitcoin', 'html_placeholder' => 'Nwhr7ndm6N...ZDAwcLHbHVJ7'],
        ['name' => 'Адрес BitcoinCash', 'html_placeholder' => '9GtbYNC58K...4xfyeWEhWLkG'],
        ['name' => 'Адрес Ethereum', 'html_placeholder' => '0x123f6816...cc8565a0c2ac'],
        ['name' => 'Адрес Litecoin', 'html_placeholder' => 'StacPGkfF6C...tRFLEYkHEV3'],
        ['name' => 'EXMO код', 'html_placeholder' => ''],
        ['name' => 'Адрес Ripple', 'html_placeholder' => '3YFCT2J9FZJ...DAwvG25jLch'],
        ['name' => 'Тег Ripple', 'html_placeholder' => ''],
        ['name' => 'Адрес Monero', 'html_placeholder' => ''],
        ['name' => 'Адрес Z-Cash', 'html_placeholder' => ''],
        ['name' => 'Адрес DASH', 'html_placeholder' => '']
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
     * Rules for BaseModel::safeInsertCheck and BaseModel::safeCreate methods.
     *
     * @param integer $edit_id
     * @return array
     */
    public static function getRules($edit_id = 0) {
        return [
            'name' => 'required|string|max:100|unique:' . self::tableName() . ',name'
                . ($edit_id ? ',' . $edit_id : ''),
            'html_placeholder' => 'nullable|string|max:100',
        ];
    }

    /**
     * Handles BaseModel::safeDeactivate method.
     *
     * @return void
     */
    public function deactivate() {}
}
