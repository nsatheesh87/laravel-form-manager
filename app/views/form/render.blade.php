@extends('layouts.default')
@section('content')
@if(Session::has('success'))
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif
	 {{ Form::open(array('url' => 'form/storedata', 'class' => 'form-horizontal')) }}
	 	 <fieldset>
	    	<legend>{{ $response['formHeader']->name }}</legend>
	    	{{ Form::hidden('formid', $response['formHeader']->id); }}
	 		{{ $response['formHtml'] }}
	 		<div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-default">Cancel</button>
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
	    	</div>
	 		</fieldset>
	 {{ Form::close() }}
	
@stop
