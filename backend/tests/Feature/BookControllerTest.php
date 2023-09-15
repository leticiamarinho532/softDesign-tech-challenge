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
                'title',
                'author',
                'page_numbers',
            ]);
    }

    public function testShouldListAllBooks()
    {
        // Act
        $response = $this->get('api/books?pagination=10');

        // Assert
        dd($response);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'author',
                    'page_numbers',
                ]
            ]);
    }

    public function testShouldListOneBook()
    {
        // Act
        $response = $this->get('api/books/1');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'title',
                'author',
                'page_numbers',
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
        $response->assertStatus(201)
            ->assertJsonStructure([
                'title',
                'author',
                'page_numbers',
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
