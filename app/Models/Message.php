<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var string[]
     */
    protected $fillable = [
        'book_id',
        'message',
        'action',
        'read',
    ];

    /**
     * @return BelongsTo
     */
    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
