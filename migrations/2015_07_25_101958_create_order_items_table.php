<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderItems', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('line_item_id')->unsigned();
						$table->string('line_item_type');
            $table->float('price', 10, 2);
            $table->integer('quantity');
						$table->double('vat');
            $table->float('total_price', 10, 2);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

						// // custom fields
						// $table->string('description')->nullable();
						// $table->string('currency')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orderItems');
	}

}
