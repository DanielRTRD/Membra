@extends('layouts.base.main')
@section('title', 'Change Images')
@section('content')
	<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<h2>Change Images</h2>
			<hr>
			<div class="row">
				<div class="col-lg-3">
					@include('layouts.base.account-sidebar')
				</div>
				<div class="col-lg-9">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group @if ($errors->has('profilepicture')) has-error @endif">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 250px; height: 250px;">
									<img src="http://placehold.it/250x250" data-src="http://placehold.it/250x250" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="height:auto; width:auto; max-width: 250px; max-height: 250px;"></div>
								<div>
									<span class="btn-file">
										<span class="btn btn-primary btn-labeled fileinput-new"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Select image</span>
										<span class="btn btn-warning btn-labeled fileinput-exists"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Change</span>
										<input type="file" name="profileimage">
									</span>
									<a href="#" class="btn btn-labeled btn-danger fileinput-exists" style="margin-top:12px;" data-dismiss="fileinput"><span class="btn-label"><i class="fa fa-remove"></i></span>Remove</a>
								</div>
							</div>
							@if($errors->has('profilepicture'))
								<p class="text-danger">{{ $errors->first('profilepicture') }}</p>
							@endif
						</div>
						<hr>
						<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-success"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload</button></p>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
					<!--<img alt="{{$username}}" src="@if($profilepicture){{$profilepicture}}@else{{{'/img/profilepicture/0.png'}}}@endif" class="img-thumbnail">
					<form action="" method="post" enctype="multipart/form-data">

						<div class="form-group @if ($errors->has('profilepicture')) has-error @endif">
							<br>
							<input type="file" name="profilepicture">
							@if($errors->has('profilepicture'))
								<p class="text-danger">{{ $errors->first('profilepicture') }}</p>
							@endif
						</div>
						<hr>
						<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Change</button></p>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>-->
				</div>
			</div>
		</div>
	</div>
</div>
@stop