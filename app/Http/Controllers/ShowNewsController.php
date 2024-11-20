<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class ShowNewsController extends Controller
{
    public function show($id)
    {
        $news = News::findOrFail($id);
        

        return view('admin.news.show', compact('news'));
    }
}
