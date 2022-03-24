<?php

namespace App\Models\ToSell;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToSell extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','user_id','quantity'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}