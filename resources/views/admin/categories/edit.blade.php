@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Edit Category</h1>
		<br>
		<form method="post">
			{!! csrf_field() !!}
			<label for="title">Input The Title of The Category</label>
			<input type="text" name="title" class="form-control" value="{{ $category->title }}">
			<br>
			<label for="description">Category Text</label>
			<textarea name="description" class="form-control">{!! $category->description !!}</textarea>
			<button type="submit" class="btn btn-success" style="margin-top:20px;">Edit Category</button>
		</form>
	</main>
@endsection
