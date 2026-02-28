<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'original_url',
        'clicks',
        'last_click',
        'user_id',
    ];

    protected $casts = [
        'last_click' => 'datetime',
        'clicks' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateCode($length = 6)
    {
        do {
            $code = Str::random($length);
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
