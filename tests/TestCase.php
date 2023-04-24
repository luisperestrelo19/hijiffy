<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * refactored method to work with jwt token
     *
     * @param [type] $user
     * @param [type] $driver
     * @return void
     */
    public function actingAs($user, $driver = null) : self
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");
        parent::actingAs($user);

        return $this;
    }
}
