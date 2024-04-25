<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'publisher_id',
        'category_id',
        'file_name',
        'cover',
        'title',
        'writer',
        'desc',
        'year',
        'book_count',
        'is_active'
    ];

    public function publisher() : BelongsTo {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
