<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'species',
        'color',
        'dob',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
