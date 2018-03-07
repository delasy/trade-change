<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\PasswordReset as m_PasswordReset;

class PasswordReset extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_PasswordReset::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->index();
            // TODO fix token length
            $table->string('token', 255);
            // TODO check if this has to be $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists(m_PasswordReset::tableName());
    }
}
