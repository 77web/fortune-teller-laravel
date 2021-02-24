<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fortune extends Model
{
    use HasFactory;

    protected $table = 'fortunes';

    protected $attributes = [
        'target_date' => null,
        'target_sign' => '',
        'fortune_text' => '',
    ];
}
