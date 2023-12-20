<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransactions extends Model
{
    use HasFactory;

    protected $table = 'stock_transactions';
    protected $fillable = [
        'product_id',
        'supplier_id',
        'user_id',
        'type',
        'quantity',
        'transaction_date',
        'note',
        'status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
