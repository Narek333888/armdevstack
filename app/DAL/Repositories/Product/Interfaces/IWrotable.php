<?php

namespace App\DAL\Repositories\Product\Interfaces;

use App\Models\Product;


interface IWrotable
{
    public function create(array $data);
    public function update(int|Product $product, array $data);
    public function softDelete(int|Product $product);
    public function delete(int|Product $product);
    public function copy(int $id);
    public function softDeleteMultiple(array $data);
    public function deleteMultiple(array $data);
    public function deleteAll();
    public function softDeleteAll();
}
