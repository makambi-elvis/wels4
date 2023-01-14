<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;

    protected $fillable = [
        'hireRequest_id',
        'electronic_id',
        'owner_id',
        'customer_id',
        'start_date',
        'return_date',
        'returned'
    ];

    //relationship to user

    public function user(){
        return $this->belongsTo(User::class, 'owner_id');
    }
}
