<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'published_at',
        'updated_at',
    ];

    /**
     * The attributes that are casted
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id',
    ];

    /**
     * The user that added the book
     *
     * @return  BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
