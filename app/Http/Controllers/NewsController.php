<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $news = News::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%');
        })->paginate(3);

        return view('admin.news.index', compact('news', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:news',
            'category_id' => 'required|array',
            'body'=>'required',
        ]);

        $news = News::create([
            'name' => $request->name,
            'description' => $request->description,
            'body' => $request->body,
        ]);
        $news->categories()->attach($request->input('category_id'));

        session()->flash('Add', 'new created successfully');

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $news = News::findOrFail($id);

        // return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'name' => 'required',
             'category_id' => 'required|array',
             'body'=>'required',
        ]);
        $news->update([
            'name' => $request->name,
            'description' => $request->description,
            'body' => $request->body,
        ]);
        $news->categories()->sync($request->input('category_id'));
        session()->flash('Edit', 'new updated successfully');

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        session()->flash('delete', 'new deleted successfully');
        return redirect()->route('news.index');
    }
}
