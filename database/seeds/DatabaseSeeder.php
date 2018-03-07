<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call([
            CurrImgTableSeeder::class,
            CurrInputTableSeeder::class
        ]);
    }

    /**
     * @param \App\Models\BaseModel $class
     * @param string $text_before
     * @param array $data
     * @return void
     */
    public static function tryInsert($class, $text_before, $data) {
        echo "\n$text_before: ";
        $start = microtime(true);

        try {
            $class::safeCreate($data);

            echo 'INSERTED ' . number_format(microtime(true) - $start, 2, '.', ' ') . 's';
        } catch (\Exception $e) {
            echo 'NOT INSERTED "' . $e->getMessage() . '"';
        }
    }
}
