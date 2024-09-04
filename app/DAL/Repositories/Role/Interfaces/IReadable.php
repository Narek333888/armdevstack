<?php

namespace App\DAL\Repositories\Role\Interfaces;

use App\Models\Role;

interface IReadable
{
    public function getAll();
    public function getAllPaginated(int $perPage = 10);
    public function getById(int $id);
    public function getAllSelected(array $data);
    public function getAllSoftDeleted();
    public function getPermissions(Role $role);
}
