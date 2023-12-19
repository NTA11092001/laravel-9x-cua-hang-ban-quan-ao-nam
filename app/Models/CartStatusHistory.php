<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'cart_status_history';
    protected $fillable = [
        'cart_id',
        'cart_status',
        'user_id',
        'member_cancel'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function member(){
        return $this->belongsTo(Member::class,'member_cancel');
    }
}
