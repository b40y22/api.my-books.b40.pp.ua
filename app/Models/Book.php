<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed $user_id
 * @property mixed $files
 * @property mixed $description
 * @property mixed $pages
 * @property mixed $title
 * @property mixed $year
 */
class Book extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'books';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'files',
        'description',
        'pages',
        'title',
        'year',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'user_id',
        'pivot',
    ];

    protected $casts = [
        'files' => 'json',
    ];

    /**
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany
    {
        return $this
            ->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
