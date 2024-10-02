<?php

namespace App\Repositories\PostCategory\Interfaces;

use App\Models\PostCategory;

interface IWrotable
{
    public function create(array $data);
    public function update(int|PostCategory $postCategory, array $data);
    public function softDelete(int|PostCategory $postCategory);
    public function delete(int|PostCategory $postCategory);
    public function copy(int $id);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
