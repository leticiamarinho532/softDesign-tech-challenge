<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function store($bookInfos);

    public function list($pagination);

    public function listOne($bookId);

    public function update($id, $bookInfos);

    public function delete($bookId);
}