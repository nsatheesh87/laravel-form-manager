@extends('layouts.default')
@section('content')
	{{ Form::open(array('url' => 'form/store', 'class' => 'form-horizontal')) }}
	  <fieldset>
	    <legend>Create New Form</legend>

	    <div class="form-group">
	      <label for="formName" class="col-lg-2 control-label">Form Name</label>
	      <div class="col-lg-10">
	        <input class="form-control" id="name" name="name" placeholder="Enter your form name" type="text">
	      </div>
	    </div>
	    
	    <div class="form-group">
	      <label for="s_message" class="col-lg-2 control-label">Success Message</label>
	      <div class="col-lg-10">
	        <textarea class="form-control" rows="3" name="s_message" id="s_message"></textarea>
	        <span class="help-block">This message will be shown to the user after the form submission.</span>
	      </div>
	    </div>

	    <div class="form-group">
	      <label class="col-lg-2 control-label">Status</label>
	      <div class="col-lg-10">
	        <div class="radio">
	          <label>
	            <input name="publish" id="publish1" value="1" type="radio">
	            Publish
	          </label>
	        </div>
	        <div class="radio">
	          <label>
	            <input name="publish" id="publish2" value="0" checked="" type="radio">
	            UnPublish
	          </label>
	        </div>
	      </div>
	    </div>
	    
	    <div class="form-group">
	      <div class="col-lg-10 col-lg-offset-2">
	        <button class="btn btn-default">Cancel</button>
	        <button type="submit" class="btn btn-primary">Submit</button>
	      </div>
	    </div>
	  </fieldset>
	{{ Form::close() }}
@stop
