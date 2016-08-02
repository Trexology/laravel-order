<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Artisan::call('migrate', ["--force"=> true, "--path"=> "vendor/venturecraft/revisionable/src/migrations" ]);

		Schema::create('orders', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('state');
            $table->integer('items_number')->unsigned();
            $table->float('items_total', 15, 2);
            $table->integer('adjustments_numbers')->nullable();
            $table->float('adjustments_total', 15, 2)->nullable();
            $table->dateTime('completed_at')->nullable();
						$table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

						// //custom fields
						// $table->string('cust_first_name')->nullable();
						// $table->string('cust_last_name')->nullable();
						// $table->string('cust_address')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
