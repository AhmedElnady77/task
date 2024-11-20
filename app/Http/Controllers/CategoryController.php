<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(3);

        $news = News::all();

        return view('admin.categories.index', compact('categories', 'news', 'search'));
    }
    // $cat = NewsCategory::find(5);
    // $news = $cat->news;
    // dd($news);

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
            'parent_id' => $request-> input('categories'),
            ]);

            session()->flash('Add', 'category created successfully');




        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $Category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $Category)
    {
       $tags= $Category->news;
       $categories = Category::all();



        return view('admin.categories.edit', compact('Category', 'tags','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $Category)
    {
        $request->validate(['name' => 'required']);

        $Category->update([
            'name' => $request->name,
            'parent_id' => $request->input('categories'),

        ]);
        // $newsCategory->update($request->except('news'));

        // $news= explode(',',$request->post('news'));
        // $new_ids=[];
        // foreach($news as $n_new){

        //     $slug=str::slug($n_new);
        //     $new=News::where('slug',$slug)->first();
        //     if(!$new){
        //         $new=News::create([
        //             'name'=>$n_new,
        //             'slug'=>$slug,
        //         ]);
        //     }
        //     $new_ids[]=$new->id;
        //     $newsCategory->news()->sync($new_ids);
        // }
        session()->flash('Edit', 'category updated successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {
        if ($Category->children()->exists()) {
            session()->flash('Error', 'This category has subcategories. You cannot delete it.');

            return redirect()->back();
        }
        $Category->delete();
        session()->flash('delete', 'category deleted successfully');
        return redirect()->route('categories.index');
    }
}
