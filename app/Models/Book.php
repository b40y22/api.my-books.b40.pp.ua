<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

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
        'description',
        'pages',
        'title',
        'year',
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
}