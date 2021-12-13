<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email'
    ];

    public function products(){

        /* Para crear una relación de muchos a muchos se usa el método belongsToMany
           que debe presentar la siguiente estructura:
           
        return $this->belongsToMany(
            RelatedModel, 
            pivot_table_name, 
            foreign_key_of_current_model_in_pivot_table, 
            foreign_key_of_other_model_in_pivot_table);*/

        return $this->belongsToMany(
            Product::class,
            'products_customers',
            'customer_id',
            'product_id');
    }
}
