<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forms_list', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('s_message');
			$table->tinyInteger('publish');
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
		Schema::table('forms_list', function(Blueprint $table)
		{
			Schema::drop('forms_list');
		});
	}

}
