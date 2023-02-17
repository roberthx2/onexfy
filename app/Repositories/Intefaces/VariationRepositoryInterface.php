<?php

namespace App\Repositories\Intefaces;

interface VariationRepositoryInterface
{
   public function paginate(array $request);
   public function save(array $data);
   public function update($id, array $data);
   public function find($id);
   public function delete($id);
   
}