<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Category extends Model
{
    use HasFactory, Slug;
    
    protected $table = 'category';

    protected $fillable = [
        'name',
        'type',
        'slug',
        'sort',
        'status'
    ];
    protected $attributes = [
        'type' => 0
    ];

    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = $model->createSlug($model->name, $model->id ? $model->id : 0);
        }); 
        
    }

    public function product(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
