<?php

namespace Tests\Unit;

use App\Services\BookService;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Tests\TestCase;
use Exception;

class BookServiceTest extends TestCase
{
    private $bookRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepositoryMock = $this->mock(BookRepositoryInterface::class);
    }

    public function testShouldCreateABook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('store')
            ->andReturn($fakeBook);
        $bookService = new BookService($this->bookRepositoryMock);
        $expectedResult = $fakeBook;

        // Act
        $result = $bookService->store($fakeBook->toArray());

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleToStoreBook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('store')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $accountService = new BookService($this->bookRepositoryMock);
        
        // Act
        $result = $accountService->store($fakeBook);

        // Assert
        $this->assertArrayHasKey('error', $result);
    }

    public function testShouldListAllBooks()
    {
        // Arrange
        $fakeBook = Book::factory()->times(10)->new();
        $this->bookRepositoryMock
            ->shouldReceive('list')
            ->andReturn($fakeBook);
        $bookService = new BookService($this->bookRepositoryMock);
        $expectedResult = $fakeBook;
        $param = 10;

        // Act
        $result = $bookService->list($param);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleToListAllBook()
    {
        // Arrange
        $this->bookRepositoryMock
            ->shouldReceive('list')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $bookService = new BookService($this->bookRepositoryMock);
        $param = 10;
        
        // Act
        $result = $bookService->list($param);

        // Assert
        $this->assertArrayHasKey('error', $result);
    }

    public function testShouldLisOneBooks()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('listOne')
            ->andReturn($fakeBook);
        $bookService = new BookService($this->bookRepositoryMock);
        $expectedResult = $fakeBook;
        $param = $fakeBook->id;

        // Act
        $result = $bookService->show($param);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleToListOneBook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('listOne')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $bookService = new BookService($this->bookRepositoryMock);
        $param = $fakeBook->id;
        
        // Act
        $result = $bookService->show($param);

        // Assert
        $this->assertArrayHasKey('error', $result);
    }

    public function testShouldUpdateABook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('update')
            ->andReturn($fakeBook);
        $bookService = new BookService($this->bookRepositoryMock);
        $expectedResult = $fakeBook;

        // Act
        $result = $bookService->update($fakeBook->id, $fakeBook->toArray());

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleToUpdateABook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('update')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $bookService = new BookService($this->bookRepositoryMock);
        
        // Act
        $result = $bookService->update($fakeBook->id, $fakeBook->toArray());

        // Assert
        $this->assertArrayHasKey('error', $result);
    }

    public function testShouldDeleteABook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('delete')
            ->andReturn($fakeBook);
        $bookService = new BookService($this->bookRepositoryMock);
        $expectedResult = 'Livro excluído.';
        $param = $fakeBook->id;

        // Act
        $result = $bookService->delete($param);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleToDeleteABook()
    {
        // Arrange
        $fakeBook = Book::factory()->new()->make();
        $this->bookRepositoryMock
            ->shouldReceive('delete')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $bookService = new BookService($this->bookRepositoryMock);
        $param = $fakeBook->id;
        
        // Act
        $result = $bookService->delete($param);

        // Assert
        $this->assertArrayHasKey('error', $result);
    }
}
