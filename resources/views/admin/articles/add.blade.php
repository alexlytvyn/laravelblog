@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Add Article</h1>
		<br>
		<form method="post">
			{!! csrf_field() !!}
			<label for="title">Select Category or Categories</label>
			<select name="categories[]" class="form-control" multiple>
				@foreach ($categories as $category)
					<option value="{{$category->id}}">{{$category->title}}</option>
				@endforeach
			</select>
			<br>
			<label for="title">Input The Title of The Article</label>
			<input type="text" name="title" class="form-control" required>
			<br>
			<label for="text_short">Article Short Text</label>
			<textarea name="text_short" class="form-control" required></textarea>
			<br>
			<label for="text_full">Article Full Text</label>
			<textarea name="text_full" class="form-control"></textarea>
			<br>
			<label for="author">Input The Autor's Name</label>
			<input type="text" name="author" class="form-control" required>
			<button type="submit" class="btn btn-success" style="margin-top:20px;">Add Article</button>
		</form>
	</main>
@endsection
