<?php

namespace App\Guards;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class SecretKeyGuard implements Guard
{
    const AUTH_HEADER = 'X-DEVAPP-Authorization';

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request  = $request;
        $this->provider = $provider;
        $this->user     = null;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return !is_null($this->user());
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        return $this->getUserBySecret();
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return string|null
     */
    public function id()
    {
        if ($user = $this->user()) {
            return $this->user()->getAuthIdentifier();
        }
    }

    /**
     * Validate a user's credentials.
     *
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (($user = $this->getUserBySecret()) != null) {
            $this->setUser($user);

            return true;
        }

        return false;
    }

    /**
     * Set the current user.
     *
     * @param  mixed $user
     * @return void
     */
    public function setUser(?Authenticatable $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Gets the user by the provided secret or returns null
     *
     * @return  null|User
     */
    protected function getUserBySecret(): ?User
    {
        return User::getBySecret($this->request->header(self::AUTH_HEADER));
    }
}
