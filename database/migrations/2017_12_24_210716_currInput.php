<?php

use App\Models\CurrInput as m_CurrInput;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrInput extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_CurrInput::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('html_placeholder', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists(m_CurrInput::tableName());
    }
}
