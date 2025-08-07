<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSelection extends Model
{
    use HasFactory;

    protected $table = 'user_selections';

    protected $fillable = [
        'name',
        'birth_year',
        'shirt_type',
        'shirt_size',
        'design_category',
        'resurge_2025',
        'no_mercy',
        'flower_of_snake',
        'gordon',
        'wing_of_love',
        'nemesis',
        'make_money_not_girlfriend',
        'born_to_die',
        'bloomrage',
        'samurai',
    ];

    protected $casts = [
        'resurge_2025' => 'boolean',
        'no_mercy' => 'boolean',
        'flower_of_snake' => 'boolean',
        'gordon' => 'boolean',
        'wing_of_love' => 'boolean',
        'nemesis' => 'boolean',
        'make_money_not_girlfriend' => 'boolean',
        'born_to_die' => 'boolean',
        'bloomrage' => 'boolean',
        'samurai' => 'boolean',
    ];
}
