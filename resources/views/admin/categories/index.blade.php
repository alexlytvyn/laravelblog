@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Categories List</h1>
		<br>
		<a href="{{route('categories.add')}}" class="btn btn-primary">Add Category</a>
		<br>
		<br>
		<table class="table table-bordered">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Description</th>
				<th>Added</th>
				<th>Updated</th>
				<th>Actions</th>
			</thead>
			<tbody>
				@foreach ($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->title}}</td>
						<td>{!! $category->description !!}</td>
						<td>{{$category->created_at->format('d-m-Y H:i')}}</td>
						<td>{{$category->updated_at->format('d-m-Y H:i')}}</td>
						<td><a href="{{ route('categories.edit', ['id' => $category->id]) }}">Edit</a> | <a href="#">Delete</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</main>
@endsection
