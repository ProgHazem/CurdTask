<?php

namespace App\Modules\Auth\tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    private TestResponse $loginResponse;

    protected function login(): void
    {
        parent::setUp();
        $this->loginResponse = $this->post('/api/v1/auth/login', [
            "email" => "Hazem_login@tafweela.com",
            "password" => "Hazem@123",
            "type" => "tafweela_operation"
        ]);
    }

    /**
     * @return void
     */
    public function test_error_logout(): void
    {
        $responseError = $this->withHeader('Accept', 'application/json')->delete('/api/v1/auth/logout');
        $responseError->assertStatus(401);
        $responseError->assertExactJson(["status" => "Error","message" => "Unauthenticated.","error" => "Unauthenticated."]);
    }

    /**
     * A test_successful_logout_response.
     *
     * @return void
     */
    public function test_successful_logout_response(): void
    {
        $this->login();
        $response = $this->withHeader('Authorization', 'bearer '.$this->loginResponse->json()['data']['authorisation']['token'])->delete('/api/v1/auth/logout');
        $response->assertStatus(200);
        $response->assertExactJson(["status" => "Success","message" => "Successfully logged out","data" => []]);
    }


}
