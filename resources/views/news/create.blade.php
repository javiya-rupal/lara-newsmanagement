@extends('app')

@section('title')
Add New News
@endsection

@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	}); 
</script>

<form action="/new-news" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
	</div>
	<div class="form-group">
		<textarea name='body'class="form-control">{{ old('body') }}</textarea>
	</div>
	<div class="form-group">
		<input required="required" value="{{ old('photo_image') }}" type="file" name = "photo_image"class="form-control" />
	</div>
	<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
	<input type="submit" name='publish_and_add' class="btn btn-success" value = "Publish and Add"/>
</form>
@endsection
