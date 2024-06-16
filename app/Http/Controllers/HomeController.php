<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Page\Models\Page;
use App\Modules\News\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout(){
        \Auth::logout();
        return redirect('/');
    }

    public function page($slug){
        $page = new Page();
        $page = $page->getPage($slug);
        return view('page', ['page' => $page]);
    }
    
    public function news(){
        $news = News::orderByDesc('created_at')->get();
        return view('news', ['news' => $news]);
    }

    public function newsView($slug){
        $news = new News();
        $news = $news->getNews($slug);
        return view('news-view', ['news' => $news]);
    }
}
