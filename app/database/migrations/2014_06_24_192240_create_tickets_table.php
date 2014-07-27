<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name_guest',100);
            $table->string('room',100);
            $table->string('group',100)->nullable();
            $table->string('request',100);
            $table->string('notes',250)->nullable();
            $table->string('report_by',100);
            $table->string('attend_by',100);
            $table->string('update_by',100)->nullable();
            $table->string('resolved_by',100)->nullable();
            $table->string('delete_by',100)->nullable();
            $table->string('status',100);
            $table->string('minutes',100)->nullable();
            $table->string('removed',100)->nullable();
            $table->string('floor',100)->nullable();
            $table->string('add_by',100);
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();      

            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
