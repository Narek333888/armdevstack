<?php

namespace App\DAL\Repositories\User\Interfaces;

use App\Models\User;

interface IReadable
{
    public function getAll();
    public function getAllPaginated(int $perPage = 10);
    public function getById(int $id);
    public function getAllSelected(array $data);
    public function getAllSoftDeleted();
    public function getSyncedRoles(User $user);
}
