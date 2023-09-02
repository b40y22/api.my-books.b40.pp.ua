<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'last_check_at',
    ];
}
