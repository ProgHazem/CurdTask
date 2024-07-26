<?php

namespace App\Modules\Auth\tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A test_successful_register_response.
     *
     * @return void
     */
    public function test_successful_login_response(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            "email" => "Hazem_login@tafweela.com",
            "password" => "Hazem@123"
        ]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_error_email_validation_login(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            "email" => "Test",
            "password" => "Hazem@123"
        ]);
        $response->assertStatus(422);
        $response->assertExactJson(["status" => "Error","message" => "Email must be Valid","error" => ["email" => ["Email must be Valid"] ] ]);
    }

    /**
     * @return void
     */
    public function test_all_errors_validation_login(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            "email" => "Test",
            "password" => "Hazem"
        ]);
        $response->assertStatus(422);
        $response->assertExactJson(["status" => "Error","message" => "Email must be Valid (and 1 more error)","error" =>  ["email" => ["Email must be Valid"],"password" => ["Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character"] ] ]);
    }

    /**
     * @return void
     */
    public function test_error_email_Not_Exist_login(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            "email" => "Hazem_login@tafweela",
            "password" => "Hazem@123"
        ]);
        $response->assertStatus(404);
        $response->assertExactJson(["status" => "Error","message" => "Admin Not found","error" => 'Admin Not found']);
    }

    /**
     * @return void
     */
    public function test_error_invalid_Credentials_login(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            "email" => "Hazem_login@tafweela.com",
            "password" => "Hazem@12353"
        ]);
        $response->assertStatus(404);
        $response->assertExactJson(["status" => "Error","message" => "invalid Credentials","error" =>  'invalid Credentials']);
    }
}
