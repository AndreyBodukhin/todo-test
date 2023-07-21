<?php

namespace App\Todo\Models;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    protected $fillable = ['user_id', 'text', 'image'];
}
