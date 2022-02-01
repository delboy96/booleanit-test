<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $cat_id
 * @property string $product_number
 * @property string $category_name
 * @property string $department_name
 * @property string $manufacturer_name
 * @property float $upc
 * @property float $sku
 * @property float $regular_price
 * @property float $sale_price
 * @property string $description
 * @property-read Category $category
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCatId($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereProductNumber($value)
 * @method static Builder|Product whereRegularPrice($value)
 * @method static Builder|Product whereSalePrice($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereUpc($value)
 * @mixin Eloquent
 * @property int $dep_id
 * @property int $man_id
 * @property-read Department $department
 * @property-read Manufacturer $manufacturer
 * @method static Builder|Product whereDepId($value)
 * @method static Builder|Product whereManId($value)
 */
class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = ['cat_id', 'dep_id', 'man_id', 'product_number', 'upc', 'sku', 'regular_price', 'sale_price', 'description'];


    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    /**
     * @return BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'man_id');
    }
}
