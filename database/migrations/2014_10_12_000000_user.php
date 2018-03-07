<?php

use App\Models\User as m_User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared(
            'CREATE OR REPLACE FUNCTION update_updated_at_column() RETURNS TRIGGER AS $$ BEGIN '
            . 'NEW.updated_at = now(); RETURN NEW; END; $$ language \'plpgsql\';'
        );

        Schema::create(m_User::tableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::unprepared(
            'CREATE TRIGGER update_' . m_User::tableName() . '_updated_at BEFORE UPDATE ON '
            . m_User::tableName() . ' FOR EACH ROW EXECUTE PROCEDURE update_updated_at_column()'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER update_' . m_User::tableName() . '_updated_at ON ' . m_User::tableName());
        Schema::dropIfExists(m_User::tableName());
        DB::unprepared('DROP FUNCTION update_updated_at_column()');
    }
}
