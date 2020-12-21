<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const ACTIVE = 'active';
    public const PENDING = 'pending';

    public const POSSIBLE_STATUSES = [
        self::ACTIVE,
        self::PENDING,
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
