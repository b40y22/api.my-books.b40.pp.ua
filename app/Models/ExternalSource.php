<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed $title
 * @property mixed $active
 * @property mixed $url
 * @property mixed $class_name
 * @property mixed $status
 * @property mixed $change_status_at
 */
class ExternalSource extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'external_sources';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'active',
        'url',
        'class_name',
        'status',
        'change_status_at',
    ];
}
