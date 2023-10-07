<?php

namespace Tests\Unit;

use App\Services\TestHttpServices;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ConnectionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        Http::fake([
            'http://sports.core.api.espn.com/v2/sports/soccer/leagues' => Http::response([
                'id' => '33',
                'name' => 'Soccer',
                'slug' => 'soccer'
            ], 200)
        ]);

        $http = new TestHttpServices();
        $response = $http->testGet('http://sports.core.api.espn.com/v2/sports/soccer/leagues');
        $this->assertSame('soccer', $response['slug']);
    }
}
