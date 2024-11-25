<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('dashboard');
            } else {
                
                return redirect(route('home.page'));
            }
        } else {
            return redirect('/login');
        }
    }

    public function home(){
        $show_news = News::paginate(6);
        $categories=Category::whereNull('parent_id')->get();
        return view('user.home', compact('show_news', 'categories'));
    }

    public function user(){
        $categories=Category::all();
        return view('user.user', compact('categories'));
    }


}
