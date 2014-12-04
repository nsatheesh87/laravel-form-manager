@extends('layouts.default')
@section('content')
@if(Session::has('success'))
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="page-header">
    <h1 id="tables">Manage Forms</h1>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Form Title</th>
      <th>Message</th>
      <th>Status</th>
      <th>Created at </th>
      <th>Updated at </th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $form)
  <tr>
    <td> {{ $form->id }} </td>
    <td>
     {{ link_to_route('form_viewdata', $form->name, array($form->id)) }} </td>
    <td> {{ $form->s_message }} </td>
    <td> {{ $form->publish }} </td>
    <td> {{ $form->created_at }} </td>
    <td> {{ $form->updated_at }} </td>
  </tr>
  @endforeach
  </tbody>
  </table>
  {{ $data->links() }}
@stop