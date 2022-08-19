<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_slug',
        'price',
        'description',
        'created_at',
        'updated_at',
    ];

    public function assets()
    {
        return $this->belongsToMany(
            Asset::class,
            'assets_products',
            'product_id',
            'asset_id',
        );
    }
}
