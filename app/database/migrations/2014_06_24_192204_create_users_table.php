<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('full_name',100);
            $table->string('username',100)->unique();
            $table->string('view',255);
            $table->string('email',255);
            $table->string('password');
            //$table->string('password_confirmation');
            $table->enum('type', ['superadmin', 'usuario', 'admin']);
            $table->string('remember_token')->nullable();
			
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
