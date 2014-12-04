<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Formlists extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'forms_list';

	protected $fillable = ['name','s_message','publish'];

	public $errors;

	public  $rules = ['name' => 'required','s_message' => 'required'];

	public function isValid()
	{
		$validation = Validator::make($this->attributes,$this->rules);
		if($validation->passes()) return true;
		$this->errors = $validation->messages();
		return false;
	}


}
