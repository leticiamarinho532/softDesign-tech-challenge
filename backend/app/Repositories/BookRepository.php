<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function store($bookInfos)
    {
        return Book::create(
            [
                'title' => $bookInfos['title'],
                'author' => $bookInfos['author'],
                'page_numbers' => $bookInfos['pageNumbers']
            ]
        );
    }

    public function list($paginantion)
    {
        return Book::paginate(10);
    }

    public function listOne($bookId)
    {
        return Book::find($bookId);
    }

    public function update($id, $bookInfos)
    {
        Book::where('id', '=', $id)
            ->update([
                'title' => $bookInfos['title'],
                'author' => $bookInfos['author'],
                'page_numbers' => $bookInfos['pageNumbers']
            ]);

        return Book::find($id);
    }

    public function delete($bookId)
    {
        return Book::where('id', '=', $bookId)
            ->delete();
    }
}