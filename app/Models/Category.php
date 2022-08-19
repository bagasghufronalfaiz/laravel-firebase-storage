<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_slug',
        'asset_id',
        'created_at',
        'updated_at',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
