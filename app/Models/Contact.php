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
        'photo',
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
