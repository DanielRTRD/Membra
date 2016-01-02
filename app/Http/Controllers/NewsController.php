<?php namespace Membra\Http\Controllers;

use Membra\Http\Requests;
use Membra\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Membra\News;
use Membra\NewsCategory;

class NewsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo 'News Page';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function admin()
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.*'])){
			$news = News::all();
			return view('news.index')
						->withNews($news);
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.create'])){
			//do stuff
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.create'])){
			//do stuff
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		dd($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.update'])){
			$news = News::find($id);
			$categories = NewsCategory::all();
			return view('news.edit')->withArticle($news)->withCategories($categories);
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.update'])){
			//has access
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = Sentinel::findById(Sentinel::getUser()->id);
		if ($user->hasAccess(['news.destroy'])){
			//do stuff
		} else {
			return Redirect::route('account')
								->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
