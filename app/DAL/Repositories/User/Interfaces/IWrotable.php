<?php

namespace App\DAL\Repositories\User\Interfaces;

use App\Models\User;


interface IWrotable
{
    public function create(array $data);
    public function update(int|User $user, array $data);
    public function softDelete(int|User $user);
    public function delete(int|User $user);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
