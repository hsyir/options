<?php

namespace Hsy\Options\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $primaryKey = 'key';
    protected $fillable = ['key', 'value'];
}
