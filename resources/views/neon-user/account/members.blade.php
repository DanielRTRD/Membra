@extends('layouts.main')
@section('title', 'Members')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-7">
			<h2>Members</h2>
		</div>
		
		<div class="col-md-3 col-sm-5">
		<!--	
			<form method="get" role="form" class="search-form-full">
			
				<div class="form-group">
					<input type="text" class="form-control" name="s" id="search-input" placeholder="Search..." />
					<i class="fa fa-search"></i>
				</div>
				
			</form>
		-->	
		</div>

	</div>
<hr>
	@foreach($members as $member)
		<div class="member-entry">
			<a href="{{ route('user-profile', $member->username) }}" class="member-img">
				<img src="{{ $member->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
				<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
			</a>
			<div class="member-details">
				<h4>
					<a href="{{ route('user-profile', $member->username) }}">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
				</h4>
				<div class="row info-list">
					<div class="col-sm-4">
						<i class="fa fa-briefcase"></i> {{ $member->occupation }}
					</div>
					<div class="col-sm-4">
						<i class="fa fa-twitter"></i>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-facebook"></i>
					</div>
					
					<div class="clear"></div>

					<div class="col-sm-4">
						<i class="fa fa-map-marker"></i> {{ $member->location or '<em>Unkown</em>' }}
					</div>
					<div class="col-sm-4">
						<i class="fa fa-genderless"></i> {{ $member->gender }}
					</div>
					<div class="col-sm-4">
						<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($member->birthdate), date_create('today'))->y }}
					</div>
				</div>
			</div>
		</div>
	@endforeach

	<div class="row">
		<div class="col-md-12">
			{{ $members->render() }}
		</div>
	</div>

</div>

@stop