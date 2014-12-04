@extends('layouts.default')
@section('content')
@if(Session::has('success'))
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="page-header">
    <h1 id="tables">Manage Form Fields</h1>
</div>
@if(is_null($response['formHeader']))
  <div class="alert alert-dismissable alert-warning">
    <p>OOPS! Invalid Form Search</p>
  </div>
@else

<div>
  <a href="#" id="add_newfield" style="float:right;" data-toggle="modal"
   data-target="#basicModal" class="btn btn-success btn-sm">Add New Field</a>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Input Type</th>
      <th>Label</th>
      <th>Validation</th>
      <th>Additional Attributes</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
  @foreach($response['formFields'] as $field)
  <tr>
    <td> {{ $field->id }} </td>
    <td> {{ ucwords($field->fieldType) }} </td>
    <td> {{ $field->fieldTitle }} </td>
    <td> {{ $field->validation }} </td>
    <td> {{ $field->moreAttributes }} </td>
    <td> {{ $field->created_at }} </td>
    
  </tr>
  @endforeach
 
  </tbody>
  </table>
 {{ $response['formFields']->links() }}

<!--  Modal Form for generate form fields -->

  <div id="basicModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add New Field</h4>
      </div>
      {{ Form::open(array('url' => 'form/storefields', 'class' => 'form-horizontal')) }}
        <div class="modal-body">
        <fieldset>
        <div class="form-group">
        <input type="hidden" name="formid" id="formid" value="{{ $response['formHeader']->id }}" />
          <label for="fieldType" class="col-lg-3 control-label">Input Type</label>
          <div class="col-lg-6">
            <select name="fieldType" id="fieldType" class="form-control">
              <option value="text">Text Box </option>
              <option value="password">Password</option>
              <option value="textarea">TextArea</option>
              <option value="radio">Radio Button</option>
              <option value="checkbox">Check Box </option>
              <option value="dropdown">DropDown</option>
            </select>
          </div>
        </div>
        </fieldset>

        <fieldset>
        <div class="form-group">
          <label for="field_title" class="col-lg-3 control-label">Label Name</label>
          <div class="col-lg-6">
            <input class="form-control" id="fieldTitle" name="fieldTitle" placeholder="Enter the field name" type="text">
            {{ $errors->first('fieldTitle','<span class="text-warning">:message</span>') }}
          </div>
        </div>
        </fieldset>
         
          <fieldset>
          <div class="form-group">
            <label for="validation" class="col-lg-3 control-label">Validation Type</label>
            <div class="col-lg-6">
              <select name="validation" id="validation" class="form-control">
                <option value="None">No Validation </option>
                <option value="required">Required</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="alphabetic">Alphabetic</option>
                <option value="alphanumeric">AlphaNumeric</option>
              </select>
            </div>
          </div>
          </fieldset>
            <div id="text_fields">
              <fieldset>
              <div class="form-group">
                <label for="fieldLength" class="col-lg-3 control-label">Max Length</label>
                <div class="col-lg-6">
                 <input class="form-control" id="fieldLength" name="fieldLength" placeholder="Enter the max length" type="text">
                 {{ $errors->first('fieldLength','<span class="text-warning">:message</span>') }}
                </div>
              </div>
            </fieldset>
        </div>



        <div style="display:none" id="nontext_fields">
        
          <fieldset>
          <div class="form-group">
            <label for="isMultiSelect" class="col-lg-3 control-label">MultiSelect</label>
            <div class="col-lg-6">
              <input type="checkbox" name="isMultiSelect" id="isMultiSelect" value="1" />
            </div>
          </div>
          </fieldset>
        
          <fieldset>
          <div class="form-group">
            <label for="fieldOptions" class="col-lg-3 control-label">Items</label>
            <div class="col-lg-6">
              <textarea id="fieldOptions" name="fieldOptions" class="form-control"> </textarea>
              <span class="help-block">One Item Per line</span>
            </div>
          </div>
          </fieldset>
        </div>

        <fieldset>
          <div class="form-group">
            <label for="moreAttributes" class="col-lg-3 control-label">Additional Attributes</label>
            <div class="col-lg-6">
              <textarea class="form-control" id="moreAttributes" name="moreAttributes"> </textarea> 
            </div>
          </div>
        </fieldset>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      {{ Form::close() }}
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    if ({{ Input::old('autoOpenModal', 'false') }}) {
      $('#basicModal').dialog({
                    autoOpen: true,
                    width: 600,
                    buttons: {
                        "Ok": function() {
                            $(this).dialog("close");
                        }
                    }
      });

    }

    $('#fieldType').change(function(){

         var fieldType = $('#fieldType').val();
         if(fieldType == 'text' || fieldType == 'textarea' || fieldType == 'password'){
            $('#text_fields').show();
            $('#nontext_fields').hide();
            $('#validation').html( '<option value="None">No Validation </option>\
                <option value="required">Required</option>\
                <option value="email">Email</option>\
                <option value="number">Number</option>\
                <option value="alphabetic">Alphabetic</option>\
                <option value="alphanumeric">AlphaNumeric</option>');
            
         } else {
            $('#text_fields').hide();
            $('#nontext_fields').show();
            $('#validation').html('<option value="None">No Validation </option>\
                <option value="required">Required</option>');
         }

    });

});

</script>
@endif
@stop
