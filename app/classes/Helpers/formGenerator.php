<?php namespace Helpers;

class formGenerator {

	protected $errorArray = array();

    public function generateForm($fieldsArray = array(),$validationErrors='')
    {
    	if(!empty($validationErrors)){
    		$this->errorArray = $validationErrors->toArray();
    	}
    	

    	if(empty($fieldsArray))
    	{
    		return 'OOPS! There is some problem on rendering your form page';
    	}
    	$formHtml = '';
    	foreach($fieldsArray as $field)
    	{
    		 $formHtml .= $this->generateFieldHtml($field);
    	}

    	return $formHtml;

    	//return $this->formLayout('','',$formName,$formHtml);
    }


    private function createField($field)
    {
    	$fieldHtml = '';
    	switch($field->fieldType)
    	{
    		case 'text':
    		$fieldHtml = $this->createInputbox($field);
    		break;

    		case 'textarea':
    		$fieldHtml = $this->createTextarea($field);
    		break;

    		case 'radio':
    		$fieldHtml = $this->createRadio($field);
    		break;

    		case 'checkbox':
    		$fieldHtml = $this->createCheckbox($field);
    		break;

    		case 'dropdown':
    		$fieldHtml = $this->createDropdown($field);
    		break;
    	}

    	return $fieldHtml;
    	
    }

    private function generateFieldName($formID,$recordID)
    {
    	return $formID.'_field_'.$recordID;
    }
    private function createInputbox($field)
    {
    	$fieldName = $this->generateFieldName($field->formid,$field->id);
    	$fieldContent = '';
    	$fieldContent .=' <input class="form-control" '.$field->moreAttributes.' id="'. $fieldName .'" name="'. $fieldName .'" placeholder="Enter '.$field->fieldTitle.'" type="'. $field->fieldType.'">';
    	if (array_key_exists($fieldName, $this->errorArray)) {
    		$fieldContent .= '<span class="text-warning">'.$this->errorArray[$fieldName][0].'</span>';
		}
    	return $fieldContent;
    }

    private function createTextarea($field)
    {
    	$fieldName = $this->generateFieldName($field->formid,$field->id);
    	$fieldContent = '';
    	$fieldContent .=' <textarea class="form-control" '.$field->moreAttributes.' id="'. $fieldName .'" name="'. $fieldName .'"> </textarea>';
    	if (array_key_exists($fieldName, $this->errorArray)) {
    		$fieldContent .= '<span class="text-warning">'.$this->errorArray[$fieldName][0].'</span>';
		}
    	return $fieldContent;
    }

    private function createRadio($field)
    {
    	$fieldContent = '';
    	$fieldName = $this->generateFieldName($field->formid,$field->id);
		$options = explode("\n", $field->fieldOptions);
		$flag = 1;
		foreach($options as $optValue)
		{

			$fieldContent .= '<div class="radio"> <label>';
			$fieldContent .= '<input name="'.$fieldName.'" id="'.$fieldName.$flag.'" value="'.$optValue.'" checked="" type="radio">
            					'.$optValue.'</label> </div>';
            $flag++;
		}
		if (array_key_exists($fieldName, $this->errorArray)) {
    		$fieldContent .= '<span class="text-warning">'.$this->errorArray[$fieldName][0].'</span>';
		}
    	return $fieldContent;
    }

    private function createCheckbox($field)
    {
    	$fieldContent = '';
    	$fieldName = $this->generateFieldName($field->formid,$field->id);
		$options = explode("\n", $field->fieldOptions);
		$flag = 1;
		foreach($options as $optValue)
		{

			$fieldContent .= '<div class="checkbox"> <label>';
			$fieldContent .= '<input name="'.$fieldName.'" id="'.$fieldName.$flag.'" value="'.$optValue.'" type="checkbox">
            					'.$optValue.'</label></div>';
            $flag++;
		}
		if (array_key_exists($fieldName, $this->errorArray)) {
    		$fieldContent .= '<span class="text-warning">'.$this->errorArray[$fieldName][0].'</span>';
		}
    	return $fieldContent;

    }

    private function createDropdown($field)
    {
    	$fieldContent = '';
    	$fieldName = $this->generateFieldName($field->formid,$field->id);
		$options = explode("\n", $field->fieldOptions);
		$isMultiSelect = ($field->isMultiSelect == '1') ? 'multiple=""' : '';
        $fieldContent .= '<select '.$isMultiSelect.' id="'. $fieldName .'" name="'. $fieldName .'" class="form-control">';
		foreach($options as $optValue)
		{
			$fieldContent .= '<option value="'.$optValue.'"> '.$optValue.' </option>';
		}
		$fieldContent .= '</select>';

		if (array_key_exists($fieldName, $this->errorArray)) {
    		$fieldContent .= '<span class="text-warning">'.$this->errorArray[$fieldName][0].'</span>';
		}

    	return $fieldContent;
    }

    private function generateFieldHtml($field)
    {
    	//echo 'dfbgghfg'.$field->);
    	$fieldHtml = "";
    	if(!empty($field)){
	    	$fieldHtml = "<div class='form-group'>";
	    	$fieldHtml .= "<label class='col-lg-2 control-label'>".$field->fieldTitle."</label>";
	    	$fieldHtml .= "<div class='col-lg-10'>";
	    	$fieldHtml .= $this->createField($field);
		    $fieldHtml .= "</div> </div>";
    	}

    	return $fieldHtml;
    }

    public function formLayout($method='post',$action ='',$formName,$formBody='')
    {
    	// Twitter Bootsrap based layout
    	$formHeader = '<form name="postForms" class="form-horizontal" id="postForms" method= "'.$method.'" action ="'.$action.'"> <fieldset>
	    <legend>'.$formName.'</legend>';
    	$formFooter = ' <div class="form-group">
	      <div class="col-lg-10 col-lg-offset-2">
	        <button class="btn btn-default">Cancel</button>
	        <button type="submit" class="btn btn-primary">Submit</button>
	      </div>
	    </div></fieldset></form>';

    	return $formHeader.$formBody.$formFooter;

    }
}

