<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city','country',
        'weather', 'weather_description', 'weather_icon',
        'temp_min', 'temp_max',
        'lat', 'lng',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
