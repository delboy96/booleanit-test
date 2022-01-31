<?php

namespace App\Models;

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
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereManufacturerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRegularPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpc($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = ['cat_id', 'product_number', 'category_name', 'department_name', 'manufacturer_name', 'upc', 'sku', 'regular_price', 'sale_price', 'description'];


    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
