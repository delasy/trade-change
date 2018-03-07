<?php

use Illuminate\Database\Seeder;
use App\Models\CurrInput;

class CurrInputTableSeeder extends Seeder {
    /**
     * Run specified table seeds.
     *
     * @return void
     */
    public function run() {
        $i = 0;
        $need_echo_end = false;

        foreach (CurrInput::$ALL_INPUTS as $input) {
            if (($check = CurrInput::safeInsertCheck($input)) !== true) {
                // dd($check);
                continue;
            }

            if ($i === 0) {
                echo "---------------------------------------\n";
                echo '| Currency Input';
                $need_echo_end = true;
            }

            DatabaseSeeder::tryInsert(new CurrInput, '|-- ' . $input['name'], $input);

            $i++;
        }

        if ($need_echo_end) {
            echo "\n---------------------------------------\n";
        }
    }
}
