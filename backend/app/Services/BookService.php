<?php

namespace App\Services;

use App\Interfaces\BookRepositoryInterface;
use Exception;

class BookService
{
    public function __construct(
        private BookRepositoryInterface $bookRespository
    )
    {
    }

    public function store($bookInfos)
    {
        try {
            return $this->bookRespository->store($bookInfos);
        } catch (Exception $e)
        {
            return ['error' => true, 'message' => 'Não foi possível salvar um livro.', 'code' => 406];
        }
    }

    public function list($pagination)
    {
        try {
            return $this->bookRespository->list($pagination);
        } catch (Exception $e)
        {
            return ['error' => true, 'message' => 'Não foi possível listar livros.', 'code' => 406];
        }
    }

    public function show($bookId)
    {
        try {
            return $this->bookRespository->listOne($bookId);
        } catch (Exception $e)
        {
            return ['error' => true, 'message' => 'Não foi possível listar um livro.', 'code' => 406];
        }
    }

    public function update($id, $bookInfos)
    {
        try {
            return $this->bookRespository->update($id, $bookInfos);
        } catch (Exception $e)
        {
            return ['error' => true, 'message' => 'Não foi possível atualizar um livro.', 'code' => 406];
        }
    }

    public function delete($bookId)
    {
        try {
            $result = $this->bookRespository->delete($bookId);

            if ($result) {
                return 'Livro excluído.';
            }
        } catch (Exception $e)
        {
            return ['error' => true, 'message' => 'Não foi possível deletar um livro.', 'code' => 406];
        }
    }
}