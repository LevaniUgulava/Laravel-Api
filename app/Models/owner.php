<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ownerables()
    {
        return $this->morphTo();
    }

}
