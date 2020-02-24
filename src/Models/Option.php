<?php

namespace Hsy\Options\Models;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Option extends Model
{
    protected $primaryKey = 'key';
    protected $fillable = ['key', 'value'];
}
