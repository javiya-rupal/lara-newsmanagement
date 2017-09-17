@extends('app')

@section('title')
	@if($news)
		{{ $news->title }}
	@else
		Page does not exist
	@endif
@endsection

@section('title-meta')
<p>{{ $news->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$news->author_id)}}">{{ $news->author->name }}</a></p>
@endsection

@section('content')

@if($news)
	<div>
		{!! $news->body !!}
		<a href="{{ route('newspdf',['download'=>'pdf', 'id' => $news->id]) }}">Download PDF</a>
	</div>	
@else
404 error
@endif

@endsection
