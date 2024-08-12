<?php

namespace App\DAL\Repositories\Post\Interfaces;

use App\Models\Post;


interface IWrotable
{
    public function create(array $data);
    public function update(int|Post $post, array $data);
    public function softDelete(int|Post $post);
    public function delete(int|Post $post);
    public function copy(int $id);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
