<?php

use App\Models\CurrImg as m_CurrImg;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrImg extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_CurrImg::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists(m_CurrImg::tableName());
    }
}
