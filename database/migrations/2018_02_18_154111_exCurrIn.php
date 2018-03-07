<?php

use App\Models\ExCurr as m_ExCurr;
use App\Models\ExCurrIn as m_ExCurrIn;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExCurrIn extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_ExCurrIn::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ex_curr_out_id');
            $table->integer('ex_curr_in_id');
            $table->boolean('status')->default('1');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('ex_curr_out_id')->references('id')->on(m_ExCurr::tableName());
            $table->foreign('ex_curr_in_id')->references('id')->on(m_ExCurr::tableName());

            $table->unique(['ex_curr_out_id', 'ex_curr_in_id']);
        });

        DB::unprepared(
            'CREATE TRIGGER update_' . m_ExCurrIn::tableName() . '_updated_at BEFORE UPDATE ON '
            . m_ExCurrIn::tableName() . ' FOR EACH ROW EXECUTE PROCEDURE update_updated_at_column()'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER update_' . m_ExCurrIn::tableName() . '_updated_at ON ' . m_ExCurrIn::tableName());

        Schema::table(m_ExCurrIn::tableName(), function (Blueprint $table) {
            $table->dropUnique(m_ExCurrIn::tableName() . '_ex_curr_out_id_ex_curr_in_id_unique');
            $table->dropForeign(m_ExCurrIn::tableName() . '_ex_curr_out_id_foreign');
            $table->dropForeign(m_ExCurrIn::tableName() . '_ex_curr_in_id_foreign');
        });

        Schema::dropIfExists(m_ExCurrIn::tableName());
    }
}
