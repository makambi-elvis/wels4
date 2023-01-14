<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'electronic_id',
        'name',
        'location',
        'phone_number',
        'days',
        'message',
        'accepted',
        'rejected'
    ];

    //relationshionship to user

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //relationship to electronic

    public function electronic(){
        return $this->hasOne(Electronic::class, 'electronic_id');
    }


}
