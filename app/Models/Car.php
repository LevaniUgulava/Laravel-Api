<?php

namespace App\Models;

use App\Models\owner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function owners()
    {
        return $this->morphMany(owner::class, 'ownerable');
    }
}
