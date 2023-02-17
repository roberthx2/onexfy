<?php

namespace App\Repositories;

use App\Repositories\Intefaces\ProductRepositoryInterface;
use App\Models\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
    * @var Product
    */
    protected $model;

 
    public function __construct(Product $model)
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
        $product = $this->model->findOrFail($id);
        $product->update($data);

        return $product;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        $product = $this->model->findOrFail($id);
        $product->delete();

        return $product;
    }
}