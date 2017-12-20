@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Add Category</h1>
		<br>
		<form method="post">
			{!! csrf_field() !!}
			<label for="title">Input The Title of The Category</label>
			<input type="text" name="title" class="form-control">
			<br>
			<label for="description">Category Text</label>
			<textarea name="description" class="form-control"></textarea>
			<button type="submit" class="btn btn-success" style="margin-top:20px;">Add Category</button>
		</form>
	</main>
@endsection
