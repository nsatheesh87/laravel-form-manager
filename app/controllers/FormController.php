<?php

class FormController extends BaseController {

	protected $form;

	public function  __construct(Formlists $form)
	{
		$this->form = $form;
		$this->formfields = new FieldGenerator();
		$this->formHelper = new Helper();
	}

	public function create()
	{
		return View::make('form.create');
	}

	public function store()
	{
		$input = Input::all();
		$this->form->fill($input);
		if(!$this->form->isValid()){
			return Redirect::back()->withInput()->withErrors($this->form->errors);
		}

		$this->form->save();
		return Redirect::to('form/list')->with('success', 'New form has been created successfully!');
	}

	public function listdata()
	{
		$form_lists = $this->form->paginate(10);
		return View::make('form.list')->with('data',$form_lists);
	}

	public function generateFields($formID)
	{
		$response = array();
		$formExists = $this->form->where('id', '=', $formID)->first();
		$formFields = '';
		if(!is_null($formExists))
		{
			$formFields = $this->formfields->where('formid', '=', $formID)->paginate(10);
		}
		$response['formHeader'] = $formExists;
		$response['formFields'] = $formFields;
	  return View::make('form.generateFields')->with('response',$response);
	}

	public function storefields()
	{
		$input = Input::all();
		$this->formfields->fill($input);
		if(!$this->formfields->isValid($input)){
			$input['autoOpenModal'] = 'true';
			return Redirect::back()->withInput($input)->withErrors($this->formfields->errors);
		}
		$this->formfields->save();
		$redirectTo = 'form/generatefields/'.Input::get('formid');
		return Redirect::to($redirectTo)->with('success', 'New field has been generated successfully!');
	}

	public function render($formID)
	{
		$errors = '';
		$response = array();
		if(Session::has('errors')){
			$errors = Session::get('errors'); 
		} 
		$formExists = $this->form->where('id', '=', $formID)->first();
		$formFields = '';
		if(!is_null($formExists))
		{
			$formFields 		     = $this->formfields->where('formid', '=', $formID)->get();
			$response['formHtml']    = $this->formHelper->generateForm($formFields,$errors);
			$response['formHeader']  = $formExists;
			return View::make('form.render')->with('response',$response);
		}

	}

	public function storedata()
	{
		$input = Input::all();
		$formID = $input['formid'];
		$formFields 		     = $this->formfields->where('formid', '=', $formID)->get(array('id','formid','validation'));
		if(!$this->formfields->isValiduserInput($input,$formFields)){
			return Redirect::back()->withInput($input)->withErrors($this->formfields->errors);
		}
		$recordID = md5(microtime().rand());
		foreach($input as $fieldKey => $fieldValue)
		{
			$formatInput = array();
			if(($fieldKey == '_token') || ($fieldKey == 'formid')){
				continue;
			}

			$formatInput['formHeaderID'] 	= $formID;
			$fieldIDarray 				= explode('_',$fieldKey);
			$formatInput['formFieldID'] 	= $fieldIDarray[2];
			$formatInput['recordID']		= $recordID;
			$formatInput['value'] 	  	= $fieldValue;
			DB::table('form_data')->insert($formatInput);				
		}
		$redirectTo = 'form/render/'.$formID;
		return Redirect::to($redirectTo)->with('success', 'Thanks for adding your information!');
		
	}

	public function viewdata($formID)
	{
		$formFields  = $this->formfields->where('formid', '=', $formID)->get(array('id','name'));
		if(!is_null($formExists))
		{
			
		}
	}


}