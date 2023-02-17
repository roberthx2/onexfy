<?php

namespace App\Models\Interfaces;

interface VariationInterface
{
    public function getID();
    public function getReference();
    public function getDescription();
    public function getPrice();
    public function getProductId();
}