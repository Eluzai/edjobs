<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // public function scopeFilter($query, array $filters){
    //     if(($filters['tag']) ?? false){
    //         $query->where('tags','like','%' . request('tag') . '%');
    //     }
    //     if(($filters['search']) ?? false){
    //         $query->where('title','like','%' . request('search') . '%')
    //         ->orwhere('description','like','%' . request('search') . '%')
    //         ->orwhere('work_type','like','%' . request('search') . '%');
    //     }
    // }

    //Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relationship to Company
    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
