<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('directory', function(Blueprint $table)
		{
			$table->increments('id')->unique();

			$table->string('full_name',255);
            $table->string('area',255);
            $table->string('ext',255);
            $table->string('direct',255);
            $table->enum('depto', ['Ama de Llaves', 'Areas Publicas', 'AyB','Desarrollo Humano','Finanzas','Mantenimiento','Recepcion','Sistemas','Seguridad','Ventas','Otro']);
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
		Schema::drop('Directory');	}

}
