<?php

namespace App\Auth;

use App\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * {@see EloquentUserProvider} that asserts that the user's status is active.
 */
class UserProvider extends EloquentUserProvider
{
    /**
     * @inheritDoc
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        if ($user instanceof User) {
            if ($user->status != User::STATUS_ACTIVE) {
                return false;
            }
        }

        return parent::validateCredentials($user, $credentials);
    }

}