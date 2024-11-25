<?php

namespace App\Http\Controllers\API;

trait ApiResponceTrait
{
    public function api($category=null,$massage=null,$status=null)
    {
        $array=[
            'data' => $category,
            'massage'=>$massage,
            'status'=>$status
          ];
          return response($array);
    }
}
