<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //DB::table()->insert()
    // Role::create
    protected $fillable = ['name', 'is_active'];

    
}
