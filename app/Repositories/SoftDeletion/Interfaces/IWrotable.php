<?php

namespace App\Repositories\SoftDeletion\Interfaces;


interface IWrotable
{
    public function restoreSoftDeleted(string $modelClass, int $id);
    public function restoreAllSoftDeleted(string $modelClass);
    public function permanentlyDeleteSoftDeleted(string $modelClass, int $id);
    public function permanentlyDeleteAllSoftDeleted(string $modelClass);
}
