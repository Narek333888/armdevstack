<?php

namespace App\Repositories\Role\Interfaces;

use App\Models\Role;

interface IWrotable
{
    public function create(array $data);
    public function update(int|Role $role, array $data);
    public function softDelete(int|Role $role);
    public function delete(int|Role $role);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
    public function syncPermissions(int|Role $role, array $permissions);
}
