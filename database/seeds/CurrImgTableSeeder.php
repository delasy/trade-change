<?php

use Illuminate\Database\Seeder;
use App\Models\CurrImg;

class CurrImgTableSeeder extends Seeder {
    /**
     * Run specified table seeds.
     *
     * @return void
     */
    public function run() {
        $i = 0;
        $need_echo_end = false;

        foreach (CurrImg::$ALL_IMAGES as $image) {
            if (($check = CurrImg::safeInsertCheck($image)) !== true) {
                // dd($check);
                continue;
            }

            if ($i === 0) {
                echo "---------------------------------------\n";
                echo '| Currency Image';
                $need_echo_end = true;
            }

            DatabaseSeeder::tryInsert(new CurrImg, '|-- ' . $image['name'], $image);

            $i++;
        }

        if ($need_echo_end) {
            echo "\n---------------------------------------\n";
        }
    }
}
