<?php

namespace App\Repositories\Intefaces;

interface ProductRepositoryInterface
{
   public function paginate();
   public function save(array $data);
   public function update($id, array $data);
   public function find($id);
   public function delete($id);
   
}