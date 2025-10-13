<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateProvince extends Model
{
    protected $table = 'states_provinces';
    protected $fillable = ['name', 'code', 'country_code', 'country_id'];
}
