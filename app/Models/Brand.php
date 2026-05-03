<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'tbl_brand';
    protected $fillable = ['brand_name', 'brand_logo', 'brand_description', 'brand_status'];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

}
