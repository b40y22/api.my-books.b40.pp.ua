<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookContext extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'book_contexts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'book_id',
        'page',
        'text',
    ];

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
