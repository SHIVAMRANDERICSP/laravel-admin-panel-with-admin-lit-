<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';



    use HasFactory;
    protected $fillable = [
        'role',
        'country',
        'country_id',
        'state',
        'state_id',
        'city',
        'city_id',
        'address_1',
        'address_2',
        'postcode',
        'how_hear',
        'tnc',
        'artist_name',
        'artist_hidden',
        'artist_image',
        'spotify_url',
    ];
}
