<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = ['name', 'surname1', 'surname2', 'email', 'phone', 'provided_capital', 'total_capital'];
}
