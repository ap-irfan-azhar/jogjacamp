<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_categories_can_be_created()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $params = [
            'page' => 1,
            'per_page' => 10,
        ];

        $response = $client->get('/api/categories', [
            'query' => $params,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('data', json_decode($response->getBody()->getContents(), true));
    }

    public function test_that_categories_can_be_filtered_by_published_status()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $params = [
            'page' => 1,
            'per_page' => 10,
            'is_published' => 1,
        ];

        $response = $client->get('/api/categories', [
            'query' => $params,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('data', json_decode($response->getBody()->getContents(), true));
    }


    public function test_that_a_category_can_be_retrieved()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $response = $client->get('/api/categories/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('data', json_decode($response->getBody()->getContents(), true));
    }

    public function test_that_a_category_can_be_created()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $params = [
            'name' => 'Test Category',
            'is_published' => 1,
        ];

        $response = $client->post('/api/categories', [
            'form_params' => $params,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('message', json_decode($response->getBody()->getContents(), true));
    }

    public function test_that_a_category_can_be_updated()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $params = [
            'name' => 'Test Category',
            'is_published' => 1,
        ];

        $response = $client->put('/api/categories/1', [
            'form_params' => $params,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('message', json_decode($response->getBody()->getContents(), true));
    }

    public function test_that_a_category_can_be_deleted()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000',
        ]);

        $response = $client->delete('/api/categories/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('message', json_decode($response->getBody()->getContents(), true));
    }

}
