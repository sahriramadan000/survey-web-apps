<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'image1',
        'image2',
        'image3',
        'image4',
        'pdf1',
        'pdf2',
        'pdf3',
        'is_available',
        'is_active',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
