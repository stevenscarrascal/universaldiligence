<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Source;

class Country extends Model
{
    protected $fillable = [
        'iso_code',
        'name',
    ];

    public function sources(){
        return $this->hasMany(Source::class);
    }
}
