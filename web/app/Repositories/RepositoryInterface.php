<?php namespace App\Repositories;
interface RepositoryInterface
{
    public function all();
    public function countData();
    public function getCertainUser($id);
}