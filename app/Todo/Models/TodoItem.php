<?php

namespace App\Todo\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection $tags
 */
class TodoItem extends Model
{
    use Taggable;

    protected $fillable = ['user_id', 'text', 'image'];
}
