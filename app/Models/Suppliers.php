<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'contact_person',
        'contact_number'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function stockTransactions(){
        return $this->hasMany(StockTransactions::class,'supplier_id');
    }

}
