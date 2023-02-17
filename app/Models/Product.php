<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Product extends Model implements ProductInterface
{
    use HasFactory;

    const TABLE_NAME = 'products';
    const ATTR_PK = 'id';
    const ATTR_NAME = 'name';
    const ATTR_REFERENCE = 'reference';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_PRICE = 'price';
    const RELATION_VARIATIONS = 'variations';

    protected $table = self::TABLE_NAME;
 
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_REFERENCE,
        self::ATTR_DESCRIPTION,
        self::ATTR_PRICE
    ];

    public function getID()
    {
        return $this->getKey();
    }

    public function getName()
    {
        return $this->{self::ATTR_NAME};
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

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function getVariations()
    {
        return $this->{self::RELATION_VARIATIONS};
    }
}
