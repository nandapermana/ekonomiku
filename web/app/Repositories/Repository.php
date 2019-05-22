<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    public function countData()
    {
        //$data = $this->all();
        $count   = count($this->all());
        return $count;
    }

    public function getCertainUser($id){
        return  $this->model::find($id);
    }
}