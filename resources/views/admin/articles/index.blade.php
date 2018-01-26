@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Articles List</h1>
		<br>
		<a href="{{route('articles.add')}}" class="btn btn-primary">Add Article</a>
		<br>
		<br>
		<table class="table table-bordered table-responsive">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Short Text</th>
				<th>Author</th>
				<th>Added</th>
				<th>Updated</th>
				<th>Actions</th>
			</thead>
			<tbody>
				@foreach ($articles as $article)
					<tr>
						<td>{{$article->id}}</td>
						<td><a href="{{ route('articles.view', ['id' => $article->id]) }}">{{$article->title}}</a></td>
						<td>{!! $article->text_short !!}</td>
						<td>{{$article->author}}</td>
						<td>{{$article->created_at->format('d-m-Y H:i')}}</td>
						<td>{{$article->updated_at->format('d-m-Y H:i')}}</td>
						<td><a href="{{ route('articles.edit', ['id' => $article->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								<a href="" class="delete" catid="{{$article->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<a href="{{ route('articles.view', ['id' => $article->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
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
					if(confirm("Are you sure you want to delete this Article?")) {
						let id = $(this).attr("catid");
						$.ajax({
							type: "DELETE",
							url: "{!! route('articles.delete') !!}",
							data: {_token:"{{csrf_token()}}", id:id},
							success: function() {
								alert("The Article was successfully deleted!");
								location.reload();
							}
						});
				} else {
						 alertify.error("Article deleting was canceled.");
				}
			});
		});
     </script>
@endsection
