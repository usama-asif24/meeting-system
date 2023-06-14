<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'date_time',
        'user_id',
        'attendees',
    ];

    protected $casts = [
        'attendees' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
