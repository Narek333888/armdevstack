<?php

namespace App\Repositories\SoftDeletion\Interfaces;


interface IReadable
{
    public function getSingleSoftDeleted(string $modelClass, int $id);
    public function getSoftDeleted(string $modelClass);
    public function getSoftDeletedPaginated(string $modelClass, int $perPage = 10);
}
