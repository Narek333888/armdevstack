<?php

namespace App\DAL\Repositories\Permission\Interfaces;

use App\Models\Permission;

interface IWrotable
{
    public function create(array $data);
    public function update(int|Permission $permission, array $data);
    public function softDelete(int|Permission $permission);
    public function delete(int|Permission $permission);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
