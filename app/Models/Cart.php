<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'member_id',
        'cart_date',
        'payment_type',
        'total',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cart_detail()
    {
        return $this->belongsToMany(Product::class, 'cart_detail', 'cart_id', 'product_id')
            ->withPivot('quantity', 'size');
    }

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
