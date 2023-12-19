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
        'estimated_arrival_date',
        'actual_arrival_date',
        'payment_type',
        'total',
        'status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cart_detail()
    {
        return $this->belongsToMany(Product::class, 'cart_detail', 'cart_id', 'product_id')
            ->withPivot('quantity', 'size','price');
    }

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function history(){
        return $this->hasMany(CartStatusHistory::class,'cart_id');
    }
}
