<?php

namespace App\Repositories\ProductCategory\Interfaces;

use App\Models\ProductCategory;

interface IWrotable
{
    public function create(array $data);
    public function update(int|ProductCategory $productCategory, array $data);
    public function softDelete(int|ProductCategory $productCategory);
    public function delete(int|ProductCategory $productCategory);
    public function copy(int $id);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
