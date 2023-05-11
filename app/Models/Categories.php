<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'ten',
        'thutu'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function product(){
        return $this->hasMany(Product::class,'id_danhmuc');
    }
}
