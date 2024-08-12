<?php

namespace App\DAL\Repositories\Post\Interfaces;

interface IReadPostsRepository
{
    public function getAll();
    public function getAllPaginated(int $perPage = 10);
    public function getById(int $id);
    public function getAllSelected(array $data);
}
