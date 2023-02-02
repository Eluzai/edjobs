<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    //Relationship to Listing
    public function listings(){
        return $this->hasMany(Listing::class, 'company_id');
    }
    //Relationship to company_image
    public function company_image(){
        return $this->hasMany(CompanyImage::class, 'company_id');
    }
}
