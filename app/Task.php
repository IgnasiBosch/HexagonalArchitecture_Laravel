<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string description
 */
class Task extends Model
{
    protected $fillable = ['description'];
}
