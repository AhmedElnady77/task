<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class NewController extends Controller
{
    use ApiResponceTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $category = Category::all();

      return  $this-> api($category,'ok',200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->api(null,$validator->errors(),400);
        }

        $category = Category::create($request->all());
        if($category){
            return $this->api($category,'saved',201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::find($id);
        if($category){
            return $this->api($category,200,'ok');
        }else {
            return $this->api([],404,'category Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->api(null,$validator->errors(),400);
        }
        $category_update=Category::find($id);
        if(!$category_update){
            return $this->api([],'category not found',404);
        }
        $category_update->update($request->all());
        if($category_update){
            return $this->api($category_update,'category updated',201);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category_delete=Category::find($id);
        if(!$category_delete){
            return $this->api([],'category not found',404);
        }
        $category_delete->delete();
        if($category_delete){
            return $this->api([],'category deleted',200);
        }
    }
}
