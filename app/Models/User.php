<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'secret_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'secret_key',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The user's books
     *
     * @return  HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Generate the api secret
     *
     * @return string
     */
    public static function generateSecret()
    {
        do {
            $secret = Str::random(64);
        } while (self::secretExists($secret));

        return $secret;
    }

    /**
     * Check if a secret already exists
     *
     * @param string $secret
     *
     * @return bool
     */
    public static function secretExists($secret)
    {
        return self::where('secret_key', $secret)->first() instanceof self;
    }

    /**
     * Get user by secret
     *
     * @param string $key
     *
     * @return bool
     */
    public static function getBySecret($secret): ?self
    {
        return self::where([
            'secret_key' => $secret,
        ])->first();
    }

    /**
     * Get user by secret
     *
     * @param string $key
     *
     * @return bool
     */
    public static function getBySecretOrFail($secret)
    {
        return self::where([
            'secret_key' => $secret,
        ])->firstOrFail();
    }
}
