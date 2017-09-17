@extends('app')

@section('title')
{{ $user->name }}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Total News</td>
					<td> {{$news_count}}</td>
					@if($author && $news_count)
					<td><a href="{{ url('/my-all-news')}}">Show All</a></td>
					@endif
				</tr>
			</table>
		</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>Latest News</h3></div>
	<div class="panel-body">
		@if(!empty($latest_news[0]))
		@foreach($latest_news as $latest_single_news)
			<p>
				<strong><a href="{{ url('/'.$latest_single_news->slug) }}">{{ $latest_single_news->title }}</a></strong>
				<span class="well-sm">On {{ $latest_single_news->created_at->format('M d,Y \a\t h:i a') }}</span>
			</p>
		@endforeach
		@else
		<p>You have not posted any news till now.</p>
		@endif
	</div>
</div>
@endsection
