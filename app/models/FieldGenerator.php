<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Former\Facades\Former;

class FieldGenerator extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'formfields';

	protected $fillable = ['formid','fieldType','fieldTitle', 'validation', 'fieldLength', 'moreAttributes', 'isMultiSelect', 'fieldOptions'];

	public $errors;

	public  $rules = ['fieldTitle' => 'required','fieldLength' => 'sometimes|numeric'];

	public $genericMessages = ['required' => 'This field is required'];
 

	public function isValid($input)
	{
		$validation = Validator::make($input,$this->rules);
		if($validation->passes()) return true;
		$this->errors = $validation->messages();
		return false;
	}

	public function isValiduserInput($input,$validation)
	{
		$validationRules = $this->validationArray($input,$validation);
		$validation = Validator::make($input,$validationRules,$this->genericMessages);
		if($validation->passes()) return true;
		$this->errors = $validation->messages();
	}

	private function validationArray($input,$validationInfo)
	{
		$validationRules = array();
		foreach($validationInfo as $validateData)
		{
			if($validateData->validation == 'None'){
				continue;
			} 

			$validationRules[$this->generateField($validateData->formid,$validateData->id)] = $this->validationRules($validateData->validation);
		}
		return $validationRules;
		//dd($input);
	}

	private function validationRules($validationText)
	{
		switch($validationText){

			case 'required':
			return 'sometimes|required';
			break;

			case 'email':
			return 'sometimes|required|email';
			break;

			case 'number':
			return 'sometimes|required|numeric';
			break;

			case 'alphanumeric':
			return 'sometimes|required|alpha_num';
			break;

		}
	}

	private function generateField($formid,$id)
	{
		return $formid.'_field_'.$id;
	}


}
