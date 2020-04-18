<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $date = Carbon::create();

        $response = $this->postJson(
            '/api/companies',
            [
                'name' => 'TimeToGetShwifty Inc.',
                'email' => 'info@ttgs.com',
                'founded' => $date->format('Y-m-d H:i:s'),
            ]
        );

        Log::debug('An informational message.');

        $response->assertStatus(200);
    }
}
