<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'status'
    ];

    public function getStatusAttribute($attribute)
    {
        return[
        2 => 'Inactive',
        1 => 'Active'
    ][$attribute];
    }
}
