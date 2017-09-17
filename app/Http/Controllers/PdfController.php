<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\News;

class PdfController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function newspdf(Request $request)
    {
        if($request->has('download') && $request->has('id')){
            $id = $request->get('id');
            $news = News::where('id', $id)->first();
            view()->share('news', $news);

            $pdf = PDF::loadView('newspdf');
            return $pdf->download('crossover-news-'.$news->slug.'.pdf');
        }
        return redirect('/');
    }
}