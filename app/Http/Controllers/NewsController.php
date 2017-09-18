<?php namespace App\Http\Controllers;

use App\News;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;

use Illuminate\Http\Request;

class NewsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = News::where('active', '1')->orderBy('created_at','desc')->paginate(10);
		return view('home')->withNews($news);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// 
		if($request->user()->can_post())
		{
			return view('news.create');
		}	
		else 
		{
			return redirect('/')->withErrors('You have not sufficient permissions for writing news');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NewsFormRequest $request)
	{
		$news = new News();
		$news->title = $request->get('title');
		$news->body = $request->get('body');
		$news->slug = str_slug($news->title);
		
		if($request->hasFile('photo_image'))
		{
	       $destinationPath = config('constants.news_image.root_dir_path');
	       $file = $request->file('photo_image');
	       $filename=$file->getClientOriginalName();
	       $request->file('photo_image')->move($destinationPath, $filename);
	       //\Image::make($request->file('photo_image'))->resize(200, 200)->save($filename);
	       $news->photo_image = $filename;
		}

		$duplicate = News::where('slug', $news->slug)->first();
		if($duplicate)
		{
			return redirect('new-news')->withErrors('Title already exists.')->withInput();
		}

        $news->author_id = $request->user()->id;
        $news->active = 1;
        $news->save();

        $redirectRoute = ($request->has('publish')) ? '/' : 'new-news';
        return redirect($redirectRoute)->withMessage("News published successfully");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$news = News::where('slug', $slug)->first();

		if($news)
		{
			if($news->active == false)
				return redirect('/')->withErrors('requested page not found');
		}
		else
		{
			return redirect('/')->withErrors('requested page not found');
		}
		return view('news.show')->withNews($news);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		//
		$news = News::find($id);
		if($news && ($news->author_id == $request->user()->id))
		{
			$news->delete();
			$data['message'] = 'News deleted Successfully';
		}
		else 
		{
			$data['errors'] = 'Invalid Operation. You have not permissions for this action';
		}
		
		return redirect('/')->with($data);
	}
}
