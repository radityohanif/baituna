<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function members()
    {
        return $this->hasMany(MemberActivity::class, 'activity_id', 'id');
    }
}
