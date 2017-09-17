<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\News;

use Illuminate\Http\Request;

class UserController extends Controller {

		/*
	 * Display the news of a particular user
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function user_news($id)
	{
		//
		$news = News::where('author_id',$id)->where('active','1')->orderBy('created_at','desc')->paginate(10);
		$title = User::find($id)->name;
		return view('home')->withNews($news)->withTitle($title);
	}

	public function user_news_all(Request $request)
	{
		//
		$user = $request->user();
		$news = News::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(10);
		$title = $user->name;
		return view('home')->withNews($news)->withTitle($title);
	}
	
	/*
	 * Verify registered user
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function verify_user($email, $verificationCode)
	{
		//		
		$user = new User();
		$isVerified = $user->verifyUser(base64_decode($email), $verificationCode);
		
		if ($isVerified) {
			return redirect('auth/login')->withMessage("Congratulations! your account has been verified. you may login and enjoy posting news!!");
		}
		else {			
			return redirect('auth/login')->withMessage("Sorry, its wrong or expired verification link you are tring to access");		
		}
	}

	/**
	 * profile for user
	 */
	public function profile(Request $request, $id) 
	{
		$data['user'] = User::find($id);
		if (!$data['user'])
			return redirect('/');

		if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
			$data['author'] = true;
		} else {
			$data['author'] = null;
		}
		$data['news_count'] = $data['user']->news->count();
		$data['news_active_count'] = $data['user']->news->where('active', 1)->count();
		$data['latest_news'] = $data['user']->news->where('active', 1)->take(10);
		
		return view('admin.profile', $data);
	}

}

