@extends('layouts.admin')
@section('content')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3 content">
		<h1>{{$article->title}}</h1>
		@if ($article->created_at == $article->updated_at)
			<span>Published: {{$article->created_at->format('d-m-Y H:i')}}</span>
		@else
			<span>Updated: {{$article->updated_at->format('d-m-Y H:i')}}</span>
		@endif
		<span>{{$article->author}}</span>
		<div class="text_full">{{$article->text_full}}</div>
		<a href="{{route('articles')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Articles</a>
	</main>
@endsection
