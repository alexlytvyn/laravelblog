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
						<td><a href="{{ route('categories.edit', ['id' => $category->id]) }}">Edit</a> |
								<a href="" class="delete" catid="{{$category->id}}">Delete</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</main>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
			$(".delete").on('click', function () {
					if(confirm("Are you sure you want to delete this Category?")) {
						var id = $(this).attr("catid");
						$.ajax({
							type: "DELETE",
							url: "{{route('categories.delete')}}",
							data: {_token:"{{csrf_token()}}", id:id},
							complete: function() {
								alert("The Category was deleted!");
								location.reload();
							}
						});
				} else {
						 alertify.error("Category deleting was canceled.");
				}
			});
		});
     </script>
@endsection
