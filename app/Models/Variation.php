<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\VariationInterface;

class Variation extends Model implements VariationInterface
{
    use HasFactory;

    const TABLE_NAME = 'variations';
    const ATTR_PK = 'id';
    const ATTR_REFERENCE = 'reference';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_PRICE = 'price';
    const ATTR_PRODUCT_ID = 'product_id';

    protected $table = self::TABLE_NAME;
 
    protected $fillable = [
        self::ATTR_REFERENCE,
        self::ATTR_DESCRIPTION,
        self::ATTR_PRICE,
        self::ATTR_PRODUCT_ID
    ];

    public function getID()
    {
        return $this->getKey();
    }

    public function getReference()
    {
        return $this->{self::ATTR_REFERENCE};
    }

    public function getDescription()
    {
        return $this->{self::ATTR_DESCRIPTION};
    }

    public function getPrice()
    {
        return $this->{self::ATTR_PRICE};
    }

    public function getProductId()
    {
        return $this->{self::ATTR_PRODUCT_ID};
    }
}
