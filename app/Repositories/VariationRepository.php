<?php

namespace App\Repositories;

use App\Repositories\Intefaces\VariationRepositoryInterface;
use App\Models\Interfaces\VariationInterface;
use App\Models\Variation;

class VariationRepository implements VariationRepositoryInterface
{
    /**
    * @var Variation
    */
    protected $model;

 
    public function __construct(Variation $model)
    {
        $this->model = $model;
    }

    public function paginate() 
    {
        return $this->model::paginate(10);
    }    

    public function save(array $data)
    {   
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $variation = $this->model->findOrFail($id);
        $variation->update($data);

        return $variation;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        $variation = $this->model->findOrFail($id);
        $variation->delete();

        return $variation;
    }
}