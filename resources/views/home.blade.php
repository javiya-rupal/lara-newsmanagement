@extends('app')

@section('title')
{{$title}}
@endsection

@section('content')

@if ( !$news->count() )
There is no news till now. Write a new news now!!!
@else
<div class="">
	@foreach( $news as $single_news )
		<div class="list-group">
		 <div class="list-group-item">
	      <h3><a href="{{ url('/'.$single_news->slug) }}">{{ $single_news->title }}</a>
	      	@if(!Auth::guest() && ($single_news->author_id == Auth::user()->id))
	          @if($single_news->active == '1')
	          <a href="{{  url('delete/'.$single_news->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
	          @endif
        	@endif
	      </h3>
	      <p>{{ $single_news->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$single_news->author_id)}}">{{ $single_news->author->name }}</a></p>
	    </div>
		<div class="list-group-item">
			<article>
				@if($single_news->photo_image != "")
				<img height="200" width="200" src="{{ Config::get('constants.news_image.url_path') .'/'. $single_news->photo_image }}" >
				@endif
				{!! str_limit($single_news->body, $limit = 300, $end = '....... <a href='.url("/".$single_news->slug).'>Read More</a>') !!}
			</article>
		</div>
	</div>
	@endforeach
	{!! $news->render() !!}
</div>
@endif

@endsection
