<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electronic extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'model',
        'owner_id',
        'image',
        'tags',
        'estimated_value',
        'cost_per_day',
        'description',
        'hired'
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('manufacturer', 'like', '%' . request('search') . '%')
                ->orWhere('model', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    //relationship to user

    public function user(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    //relationship to hire requests

    public function hire_requests(){
        return $this->hasMany(HireRequest::class, 'electronic_id');
    }
}
