<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'path',
        'size',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'assets_products',
            'asset_id',
            'product_id',
        );
    }
}
