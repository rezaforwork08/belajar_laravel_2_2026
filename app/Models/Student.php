<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'major_id',
        'name',
        'phone',
        'user_id'
    ];


    // Object relation model
    // One to one : jarang sekali dipakai
    // One to many: satu ke banyak
    // Many to many
    // user user_roles roles
    // 1    1          1
    // 1    2          2

    // major  student
    // 1       1 1
    // 1       2 1

    // belongsTo
    // left joint
    public function major()
    {
        return $this->belongsTo(Majors::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
