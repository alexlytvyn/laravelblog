@extends('layouts.app')

@section('content')
	<!-- Page Header -->
    <header class="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>{!! $article->title !!}</h1>
              <h2 class="subheading">{!! $article->text_short !!}</h2>
              <span class="meta">Posted by
                <a href="#">{!! $article->author !!}</a>
                on {!! $article->updated_at->format('d-m-Y H:i') !!}</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
						{!! $article->text_full !!}
          </div>
        </div>
      </div>
    </article>

@endsection
