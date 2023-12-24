<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillHistory extends Model
{
    use HasFactory;

    protected $table = 'bill_histories';
    protected $fillable = [
        'cart_id',
        'bill_status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
