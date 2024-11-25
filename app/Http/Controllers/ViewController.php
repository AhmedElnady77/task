<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index($id){

        $categories = Category::whereNull('parent_id')->get();
        $cat = Category::find($id);

        if (!$cat) {
            session()->flash('Error', 'Category not found.');
            return redirect()->back();
        }


        $n_news = News::whereHas('categories', function ($query) use ($cat) {
            $query->where('categories_id', $cat->id)
                  ->orWhereIn('categories_id', $cat->children->pluck('id'));
        })->paginate(3);

        return view('views', compact('n_news', 'categories','cat'));
        // $categories=Category::all();
        // $cat=Category::with('children')->find($id);
        // if (!$cat) {
        //     session()->flash('Error', 'Category not found.');
        //     return redirect()->back();
        // }
        // $n_news=$cat->news()->paginate(3);

        // return view('views', compact('n_news','categories'));
    }

//     public function index($id)
// {

//     $categories = Category::all();

//     $cat = Category::find($id);


//     if (!$cat) {
//         session()->flash('Error', 'Category not found.');
//         return redirect()->back();
//     }
//     $n_news = News::whereIn('categories_id', function ($query) use ($id) {
//         $query->select('id')
//               ->from('categories')
//               ->where('id', $id)
//               ->orWhere('parent_id', $id);
//     })->paginate(3);

//     return view('views', compact('n_news', 'categories'));
// }
}

       
