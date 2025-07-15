<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Source extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'description',
        'category',
        'type_info',
        'type_risk',
        'url',
        'video_url',
        'is_premium',
        'status',
    ];

    protected $cast =[
        'status' => 'boolean',
        'is_premium' => 'boolean',
    ];
    public function countries(){
        return $this->hasMany(Country::class);
    }
}
