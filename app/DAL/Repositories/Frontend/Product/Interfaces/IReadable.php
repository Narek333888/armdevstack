<?php

namespace App\DAL\Repositories\Frontend\Product\Interfaces;

interface IReadable
{
    public function getAll();
    public function getAllPaginated(int $perPage);
    public function getById(int $id);
}
