<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    //
    protected $fillable = [
        'name', 
        'task_id', 
        'user_id'
    ];
}
