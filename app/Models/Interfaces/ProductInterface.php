<?php

namespace App\Models\Interfaces;

interface ProductInterface
{
    public function getID();
    public function getName();
    public function getReference();   
    public function getDescription();
    public function getPrice();
    public function getVariations();
}