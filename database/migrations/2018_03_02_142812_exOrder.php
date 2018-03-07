<?php

use App\Models\User as m_User;
use App\Models\ExCurr as m_ExCurr;
use App\Models\ExOrder as m_ExOrder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExOrder extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(m_ExOrder::tableName(), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('ex_curr_in_id');
            $table->integer('ex_curr_out_id');
            $table->decimal('ex_curr_in_sum', 10, 4);
            $table->decimal('ex_curr_out_sum', 10, 4);

            $table->bigInteger('user_id');
            $table->string('user_email', 255);
            $table->string('user_phone', 20);
            $table->integer('status')->default('1');

            $table->string('ex_curr_in_field1', 255)->nullable();
            $table->string('ex_curr_in_field2', 255)->nullable();
            $table->string('ex_curr_in_field3', 255)->nullable();
            $table->string('ex_curr_in_field4', 255)->nullable();
            $table->string('ex_curr_out_field1', 255)->nullable();
            $table->string('ex_curr_out_field2', 255)->nullable();
            $table->string('ex_curr_out_field3', 255)->nullable();
            $table->string('ex_curr_out_field4', 255)->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on(m_User::tableName());
            $table->foreign('ex_curr_in_id')->references('id')->on(m_ExCurr::tableName());
            $table->foreign('ex_curr_out_id')->references('id')->on(m_ExCurr::tableName());
        });

        DB::unprepared(
            'CREATE TRIGGER update_' . m_ExOrder::tableName() . '_updated_at BEFORE UPDATE ON '
            . m_ExOrder::tableName() . ' FOR EACH ROW EXECUTE PROCEDURE update_updated_at_column()'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared(
            'DROP TRIGGER update_' . m_ExOrder::tableName() . '_updated_at ON ' . m_ExOrder::tableName()
        );

        Schema::table(m_ExOrder::tableName(), function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ex_curr_in_id']);
            $table->dropForeign(['ex_curr_out_id']);
        });

        Schema::dropIfExists(m_ExOrder::tableName());
    }
}
