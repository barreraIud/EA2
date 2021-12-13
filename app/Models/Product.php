<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'brand_id',
        'description',
        'name',
        'image',
        'price',
        'inventory',
        'seller_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    public function customers(){
        /* Para crear una relación de muchos a muchos se usa el método belongsToMany
           que debe presentar la siguiente estructura:
        
        return $this->belongsToMany(
        RelatedModel, 
        pivot_table_name, 
        foreign_key_of_current_model_in_pivot_table, 
        foreign_key_of_other_model_in_pivot_table);*/

        return $this->belongsToMany(
            Customer::class,
            'products_customers',
            'product_id',
            'customer_id');
    }
}
