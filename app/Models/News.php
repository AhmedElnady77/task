<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'body'


    ];

    public function categories()
{
    return $this->belongsToMany(Category::class,'category_news','news_id','categories_id','id','id');
}



}
