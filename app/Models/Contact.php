<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // protected $appends = ['deneme_xa'];
    protected $appends = ['durum'];

    protected $fillable = [
        'name',
        'phone',
        'photo',
        'status'
    ];

    public function getStatusTextAttribute($attribute)
    {
        return $this->statusTextOptions()[$attribute];
    }

    public function statusTextOptions()
    {
        return [
        1 => 'Active',
        2 => 'Inactive'
        //2 => 'In-Progress',
    ];
    }

    public function getDurumAttribute()
    {
        return $this->statusTextOptions()[$this->status];
    }

    // public function getDenemeXaAttribute()
    // {
    //     return 'wuhahah';
    // }
}
