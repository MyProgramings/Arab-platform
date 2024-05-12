<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lecture()
    {
        return $this->hasMany(Lecture::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
