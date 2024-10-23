<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'original_price',
        'discount_price',
        'discount_percentage',
        'start_time',
        'end_time',
        'stock',
        'status',
        'image',
    ];

    // Menambahkan accessor untuk menghitung diskon otomatis
    public function getDiscountPercentageAttribute()
    {
        return (($this->original_price - $this->discount_price) / $this->original_price) * 100;
    }

}