<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Product extends Model
{
    use HasFactory, Slug;
    protected $table = 'product';
    protected $fillable = [
        'name', 'category_id', 'slug', 'price', 'price_large', 'quantity', 'unit', 'avatar', 'desc', 'en_desc', 'china_desc', 'status'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = $model->createSlug($model->name, $model->id ? $model->id : 0);
        }); 
        
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
