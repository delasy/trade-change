<?php

use App\Models\Curr as m_Curr;
use App\Models\ExCurr as m_ExCurr;
use App\Models\CurrImg as m_CurrImg;
use App\Models\CurrInput as m_CurrInput;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExCurr extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_ExCurr::tableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('curr_id');
            $table->integer('curr_img_id');
            $table->boolean('status')->default('1');

            $table->decimal('min_val', 10, 4)->default('0.0000');
            $table->decimal('max_val', 10, 4)->default('0.0000');
            $table->decimal('reserve', 10, 4)->default('0.0000');
            $table->decimal('ex_out_rate', 10, 4)->default('0.0000');
            $table->decimal('ex_in_rate', 10, 4)->default('0.0000');
            $table->integer('ch_after_point')->default('2');

            $table->integer('field1_id')->nullable();
            $table->integer('field2_id')->nullable();
            $table->integer('field3_id')->nullable();
            $table->integer('field4_id')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('curr_id')->references('id')->on(m_Curr::tableName());
            $table->foreign('curr_img_id')->references('id')->on(m_CurrImg::tableName());
            $table->foreign('field1_id')->references('id')->on(m_CurrInput::tableName());
            $table->foreign('field2_id')->references('id')->on(m_CurrInput::tableName());
            $table->foreign('field3_id')->references('id')->on(m_CurrInput::tableName());
            $table->foreign('field4_id')->references('id')->on(m_CurrInput::tableName());

            $table->unique(['name', 'curr_id', 'curr_img_id']);
        });

        DB::unprepared(
            'CREATE TRIGGER update_' . m_ExCurr::tableName() . '_updated_at BEFORE UPDATE ON '
            . m_ExCurr::tableName() . ' FOR EACH ROW EXECUTE PROCEDURE update_updated_at_column()'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER update_' . m_ExCurr::tableName() . '_updated_at ON ' . m_ExCurr::tableName());

        Schema::table(m_ExCurr::tableName(), function (Blueprint $table) {
            $table->dropUnique(m_ExCurr::tableName() . '_name_curr_id_curr_img_id_unique');
            $table->dropForeign(['curr_id']);
            $table->dropForeign(['curr_img_id']);
            $table->dropForeign(['field1_id']);
            $table->dropForeign(['field2_id']);
            $table->dropForeign(['field3_id']);
            $table->dropForeign(['field4_id']);
        });

        Schema::dropIfExists(m_ExCurr::tableName());
    }
}
