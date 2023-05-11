<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'ten',
        'masp',
        'giathuong',
        'giakm',
        'soluong',
        'hinhanh',
        'chitiet',
        'id_danhmuc',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->belongsTo(Categories::class,'id_danhmuc');
    }
}
