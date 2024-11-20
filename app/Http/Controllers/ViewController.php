<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index($id){
        $categories=Category::all();
        $cat=Category::find($id);
        if (!$cat) {
            session()->flash('Error', 'Category not found.');
            return redirect()->back();
        }
        $n_news=$cat->news()->paginate(3);

        return view('views', compact('n_news','categories'));
    }
}

        // dd($category);

        // $news=News::all();
