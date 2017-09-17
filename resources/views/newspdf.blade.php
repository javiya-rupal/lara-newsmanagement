<style type="text/css">
	.panel-default {
		border-color: #cccccc;
	}
	.panel-default > .panel-heading {
		color: #333333;
		background-color: #f5f5f5;
		border-color: #cccccc;
		padding: 5px;
	}
</style>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>		{{ $news->title }}	</h2>
		<p>{{ $news->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$news->author_id)}}">{{ $news->author->name }}</a></p>
	</div>
	<div class="panel-body">							
		<div>{!! $news->body !!}</div>
	</div>
</div>