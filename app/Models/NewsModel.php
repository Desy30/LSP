<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsModel extends Model
{
    protected $table ='news';

    protected $fillable =[
        'author_id',
        'editor_id',
        'category_id',
        'title',
        'image',
        'slug',
        'content',
        'status',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class,
        'category_id', 'id');
    }   
    public function author(): BelongsTo
    {
        return $this->belongsTo(AuthorModel::class,
        'author_id', 'id');
    }  
   public function editor(): BelongsTo
   {
       return $this->belongsTo(EditorModel::class, 
       'editor_id', 'id');
   }    
}
