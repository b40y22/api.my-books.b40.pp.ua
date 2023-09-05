<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $author)
 * @method static paginate(int $perPage)
 * @method static orderBy(string $string, string $order)
 * @method static find(mixed $id)
 * @method static where(string $string, string $string1, string $string2)
 * @property mixed $user_id
 * @property mixed $firstname
 * @property mixed $lastname
 */
class Author extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'authors';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'user_id',
        'pivot',
    ];

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'author_book')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
