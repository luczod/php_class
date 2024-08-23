<?php

namespace App\Models;
// Eloquent(ORM)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    // by default it is string
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
