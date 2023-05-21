<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table = 'transports';
    protected $fillable = [
        'member_id',
        'name',
        'phone',
        'email',
        'address',
        'note',
        'start_date',
        'end_date',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

}
