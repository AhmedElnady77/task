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
                $categories=Category::all();
                // $news=News::all();
                return view('user.user',compact('categories'));
            }
        } else {
            return redirect('/login');
        }
    }
}
