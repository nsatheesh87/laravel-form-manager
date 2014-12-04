<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('formfields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('formid');
			$table->string('fieldType',50);
			$table->string('fieldTitle',50);
			$table->string('validation',50);
			$table->integer('fieldLength');
			$table->text('moreAttributes');
			$table->tinyInteger('isMultiSelect');
			$table->text('fieldOptions');
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
		Schema::table('formfields', function(Blueprint $table)
		{
			Schema::drop('formfields');
		});
	}

}
