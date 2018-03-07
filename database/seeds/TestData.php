<?php

use App\Models\User;
use App\Models\Curr;
use App\Models\ExCurr;
use App\Models\ExCurrIn;
use Illuminate\Database\Seeder;

class TestData extends Seeder {
    /**
     * Run test data seeds.
     *
     * @return void
     */
    public function run() {
        echo "---------------------------------------\n";

        $users = [
            ['name' => 'Main Admin', 'email' => 'aaron@delasy.com', 'password' => '123456']
        ];

        echo "| User";

        foreach ($users as $user) {
            DatabaseSeeder::tryInsert(
                new User,
                '|-- NAME(' . $user['name'] . '), PWD(' . $user['password'] . '), EMAIL(' . $user['email'] . ')',
                $user
            );
        }

        echo "\n| Currency";

        $currs = [
            [
                'name' => 'RUB', 'shortcut' => 'руб', 'full_name_1' => 'рубль', 'full_name_2' => 'рубля',
                'full_name_N' => 'рублей', 'out_text' => 'рублях'
            ],
            [
                'name' => 'UAH', 'shortcut' => 'грн', 'full_name_1' => 'гривна', 'full_name_2' => 'гривны',
                'full_name_N' => 'гривен', 'out_text' => 'гривнах'
            ],
            [
                'name' => 'USD', 'shortcut' => 'дол', 'full_name_1' => 'доллар', 'full_name_2' => 'доллара',
                'full_name_N' => 'долларов', 'out_text' => 'долларах'
            ],
            [
                'name' => 'BTC', 'shortcut' => 'btc', 'full_name_1' => 'биткоин', 'full_name_2' => 'биткоина',
                'full_name_N' => 'биткоинов', 'out_text' => 'биткоинах'
            ],
            [
                'name' => 'BCH', 'shortcut' => 'bch', 'full_name_1' => 'bitcoincash', 'full_name_2' => 'bitcoincash',
                'full_name_N' => 'bitcoincash', 'out_text' => 'bitcoincash'
            ],
            [
                'name' => 'ETH', 'shortcut' => 'eth', 'full_name_1' => 'ethereum', 'full_name_2' => 'ethereum',
                'full_name_N' => 'ethereum', 'out_text' => 'ethereum'
            ],
            [
                'name' => 'LTC', 'shortcut' => 'ltc', 'full_name_1' => 'litecoin', 'full_name_2' => 'litecoin',
                'full_name_N' => 'litecoin', 'out_text' => 'litecoin'
            ],
            [
                'name' => 'XRP', 'shortcut' => 'xrp', 'full_name_1' => 'ripple', 'full_name_2' => 'ripple',
                'full_name_N' => 'ripple', 'out_text' => 'ripple'
            ],
            [
                'name' => 'XMR', 'shortcut' => 'xmr', 'full_name_1' => 'monero', 'full_name_2' => 'monero',
                'full_name_N' => 'monero', 'out_text' => 'monero'
            ],
            [
                'name' => 'ZEC', 'shortcut' => 'zec', 'full_name_1' => 'zcash', 'full_name_2' => 'zcash',
                'full_name_N' => 'zcash', 'out_text' => 'zcash'
            ],
            [
                'name' => 'DASH', 'shortcut' => 'dash', 'full_name_1' => 'dash', 'full_name_2' => 'dash',
                'full_name_N' => 'dash', 'out_text' => 'dash'
            ],
        ];

        foreach ($currs as $curr) {
            DatabaseSeeder::tryInsert(new Curr, '|-- ' . $curr['name'], $curr);
        }

        echo "\n| Exchange Currency";

        $ex_currs = [
            [
                'name' => 'СбербанкRU', 'curr_id' => '1', 'curr_img_id' => '14', 'field1_id' => 1, 'field2_id' => 2,
                'field3_id'=> 3, 'ch_after_point' => 2, 'min_val' => 30000, 'max_val' => 200000
            ],
            [
                'name' => 'Приват24', 'curr_id' => '2', 'curr_img_id' => '11', 'field1_id' => 1, 'field2_id' => 2,
                'field3_id'=> 3, 'ch_after_point' => 2, 'min_val' => 3000, 'max_val' => 9000
            ],
            [
                'name' => 'Тинькофф', 'curr_id' => '1', 'curr_img_id' => '15', 'field1_id' => 1, 'field2_id' => 2,
                'field3_id'=> 3, 'ch_after_point' => 2, 'min_val' => 50000, 'max_val' => 300000
            ],
            [
                'name' => 'ВТБ24', 'curr_id' => '1', 'curr_img_id' => '16', 'field1_id' => 1, 'field2_id' => 2,
                'field3_id'=> 3, 'ch_after_point' => 2, 'min_val' => 50000, 'max_val' => 300000
            ],
            [
                // TODO remove unneed data
                'name' => 'Advcash', 'curr_id' => '3', 'curr_img_id' => '1', 'field1_id' => 1, 'ch_after_point' => 2,
                'min_val' => 100, 'max_val' => 100000, 'reserve' => 99000, 'ex_out_rate' => '1.1', 'ex_in_rate' => 1.2
            ],
            [
                'name' => 'Advcash', 'curr_id' => '1', 'curr_img_id' => '1', 'field1_id' => 1, 'ch_after_point' => 2,
                'min_val' => 10000, 'max_val' => 500000
            ],
            [
                'name' => 'Payeer', 'curr_id' => '3', 'curr_img_id' => '9', 'field1_id' => 4, 'ch_after_point' => 2,
                'min_val' => 100, 'max_val' => 100000
            ],
            [
                'name' => 'Perfect Money', 'curr_id' => '3', 'curr_img_id' => '10', 'field1_id' => 5,
                'ch_after_point' => 2, 'min_val' => 50000, 'max_val' => 300000
            ],
            [
                'name' => 'Яндекс.Деньги', 'curr_id' => '1', 'curr_img_id' => '17', 'field1_id' => 6,
                'ch_after_point' => 2, 'min_val' => 50000, 'max_val' => 500000
            ],
            [
                'name' => 'Qiwi', 'curr_id' => '1', 'curr_img_id' => '12', 'field1_id' => 7, 'ch_after_point' => 2,
                'min_val' => 0, 'max_val' => 0
            ],
            [
                // TODO remove unneed data
                'name' => 'Bitcoin', 'curr_id' => '4', 'curr_img_id' => '3', 'field1_id' => 8, 'ch_after_point' => 4,
                'reserve' => 10, 'ex_out_rate' => 10000, 'ex_in_rate' => 11000, 'min_val' => 0.0001,
                'max_val' => 9.991
            ],
            [
                'name' => 'BitcoinCash', 'curr_id' => '5', 'curr_img_id' => '2', 'field1_id' => 9,
                'ch_after_point' => 4
            ],
            [
                'name' => 'Ethereum', 'curr_id' => '6', 'curr_img_id' => '5', 'field1_id' => 10, 'ch_after_point' => 4
            ],
            [
                'name' => 'Litecoin', 'curr_id' => '7', 'curr_img_id' => '7', 'field1_id' => 11, 'ch_after_point' => 2
            ],
            [
                'name' => 'EXMO', 'curr_id' => '3', 'curr_img_id' => '6', 'field1_id' => 12, 'ch_after_point' => 2
            ],
            [
                'name' => 'Ripple', 'curr_id' => '8', 'curr_img_id' => '13', 'field1_id' => 13, 'field2_id' => 14,
                'ch_after_point' => 2
            ],
            [
                'name' => 'Monero', 'curr_id' => '9', 'curr_img_id' => '8', 'field1_id' => 15, 'ch_after_point' => 2
            ],
            [
                'name' => 'Z-Cash', 'curr_id' => '10', 'curr_img_id' => '18', 'field1_id' => 16, 'ch_after_point' => 2
            ],
            [
                'name' => 'Dash', 'curr_id' => '11', 'curr_img_id' => '4', 'field1_id' => 17, 'ch_after_point' => 4
            ]
        ];

        foreach ($ex_currs as $ex_curr) {
            DatabaseSeeder::tryInsert(new ExCurr, '|-- ' . $ex_curr['name'], $ex_curr);
        }

        echo "\n| Exchange Currency In";

        $ex_currs_out = [
            1  => [ 2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            2  => [ 1,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            3  => [ 1,  2,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            4  => [ 1,  2,  3,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            5  => [ 1,  2,  3,  4,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            6  => [ 1,  2,  3,  4,  5,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            7  => [ 1,  2,  3,  4,  5,  6,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            8  => [ 1,  2,  3,  4,  5,  6,  7,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            9  => [ 1,  2,  3,  4,  5,  6,  7,  8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            10 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 11, 12, 13, 14, 15, 16, 17, 18, 19],
            11 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 12, 13, 14, 15, 16, 17, 18, 19],
            12 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 13, 14, 15, 16, 17, 18, 19],
            13 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 14, 15, 16, 17, 18, 19],
            14 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 15, 16, 17, 18, 19],
            15 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 16, 17, 18, 19],
            16 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 17, 18, 19],
            17 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 18, 19],
            18 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 19],
            19 => [ 1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
        ];

        foreach ($ex_currs_out as $ex_curr_out => $ex_currs_in) {
            echo "\n|-- " . $ex_curr_out;

            foreach ($ex_currs_in as $ex_curr_in) {
                $data = ['ex_curr_out_id' => $ex_curr_out, 'ex_curr_in_id' => $ex_curr_in];
                DatabaseSeeder::tryInsert(new ExCurrIn, '|---- ' . $ex_curr_in, $data);
            }
        }

        echo "\n---------------------------------------\n";
    }
}
