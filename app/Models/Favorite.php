<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\custommer;
use App\Models\Product;
class Favorite extends Model
{
    use HasFactory;
    protected $table="tbl_favorites";
    protected $fillable = ['customer_id', 'product_id'];

    // Quan hệ với Customer
    public function customer()
    {
        return $this->belongsTo(custommer::class, 'customer_id');
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(product::class);
    }

  
}
