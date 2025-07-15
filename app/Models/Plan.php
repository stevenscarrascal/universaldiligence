<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;

class Plan extends Model
{
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
