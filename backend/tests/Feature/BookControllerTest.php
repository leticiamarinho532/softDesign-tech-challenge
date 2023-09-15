<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testShouldCreateABook()
    {
        // Arrange
        $body = [
            'title' => 'Lorem Ipsum',
            'author' => 'Dolor sit Amet',
            'pageNumbers' => rand(1, 1000)
        ];

        // Act
        $response = $this->post('api/books', $body);

        // Assert
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'title',
                'author',
                'page_numbers',
                'created_at'
            ]);
    }

    public function testShouldListAllBooks()
    {
        // Act
        $response = $this->get('api/books?pagination=10');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [[
                    'id',
                    'title',
                    'author',
                    'page_numbers',
                    'created_at'
                ]],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [[
                    'url',
                    'label',
                    'active'
                ]],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }

    public function testShouldListOneBook()
    {
        // Act
        $response = $this->get('api/books/1');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'author',
                'page_numbers',
                'created_at'
            ]);
    }

    public function testShouldUpdateABook()
    {
        // Arrange
        $body = [
            'title' => 'Lorem Ipsum',
            'author' => 'Dolor sit Amet',
            'pageNumbers' => rand(1, 1000)
        ];

        // Act
        $response = $this->put('api/books/1', $body);

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'author',
                'page_numbers',
                'created_at'
            ]);
    }

    public function testShouldDeleteABook()
    {
        // Act
        $response = $this->delete('api/books/1');

        // Assert
        $response->assertStatus(204);
    }
}
