<?php

use App\Models\Curr as m_Curr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Curr extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_Curr::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 4)->unique();
            $table->string('shortcut', 10);
            $table->string('full_name_1', 100);
            $table->string('full_name_2', 100);
            $table->string('full_name_N', 100);
            $table->string('out_text', 100);
            $table->boolean('status')->default('1');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::unprepared(
            'CREATE TRIGGER update_' . m_Curr::tableName() . '_updated_at BEFORE UPDATE ON '
            . m_Curr::tableName() . ' FOR EACH ROW EXECUTE PROCEDURE update_updated_at_column()'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER update_' . m_Curr::tableName() . '_updated_at ON ' . m_Curr::tableName());
        Schema::dropIfExists(m_Curr::tableName());
    }
}
