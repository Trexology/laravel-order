<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orderLogs', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('order_id')->unsigned();
              $table->string('old_value');
              $table->string('new_value');
              $table->string('column');
              $table->timestamp('created_at');
              $table->foreign('order_id')->references('id')->on('orders');


              DB::unprepared('
              CREATE TRIGGER tr_Log_Order_Status AFTER UPDATE ON `orders` FOR EACH ROW
                   BEGIN
                      IF OLD.state != NEW.state THEN
                        BEGIN
                          INSERT INTO orderLogs (`order_id`, `old_value`, `new_value`, `column`, `created_at`) VALUES (OLD.id, OLD.state, NEW.state, "state", now());
                        END;
                      END IF;
                   END
              ');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('orderLogs');
        DB::unprepared('DROP TRIGGER `tr_Log_Order_Status`');
    }
}
