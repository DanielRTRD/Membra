@extends('layouts.main')
@section('title', 'News - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb bc-3" >
			<li><a href=""><i class="fa fa-home"></i>Home</a></li>
			<li><a href="">Admin Panel</a></li>
			<li class="active"><strong>News</strong></li>
		</ol>

		<h2>News</h2>
		
		<br />
		<script type="text/javascript">
			jQuery(window).load(function()
			{
				tableContainer = $("#table-1");
					
				tableContainer.dataTable({
					"sPaginationType": "bootstrap",
					"bStateSave": true,

				});
			});
		</script>
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Title</th>
					<th>Category</th>
					<th>Posted at</th>
					<th>Created by</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($news as $article)
					<tr>
						<th scope="row">{{ $article->id }}</th>
						<td>{{ $article->slug }}</td>
						<td>{{ $article->title }}</td>
						<td><a href="{{ route('admin-news-category') }}"><div class="label label-info"><i class="fa fa-tag"></i> {{ $article->category->name }}</div></a></td>
						<td>{{ date(User::getUserDateFormat(), strtotime($article->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->created_at)) }}</td>
						<td><a href="{{ URL::route('user-profile', User::getUsernameByID($article->author_id)) }}">{{ User::getFullnameByID($article->author_id) }}</a></td>
						<td>
							<a href="{{ route('admin-news-edit', $article->id) }}" class="btn btn-default btn-sm btn-icon icon-left"> <i class="entypo-pencil"></i>Edit</a>
							<a href="" class="btn btn-danger btn-sm btn-icon icon-left"> <i class="entypo-cancel"></i>Delete</a>
							<a href="{{ route('news-show', $article->slug) }}" class="btn btn-info btn-sm btn-icon icon-left"> <i class="entypo-info"></i>View</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>
@stop

@section('javascript')

<script src="{{ Theme::url('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ Theme::url('js/datatables/TableTools.min.js') }}"></script>
<script src="{{ Theme::url('js/dataTables.bootstrap.js') }}"></script>
<script src="{{ Theme::url('js/datatables/jquery.dataTables.columnFilter.js') }}"></script>
<script src="{{ Theme::url('js/datatables/lodash.min.js') }}"></script>
<script src="{{ Theme::url('js/datatables/responsive/js/datatables.responsive.js') }}"></script>
@endsection