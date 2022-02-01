<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Manufacturer newModelQuery()
 * @method static Builder|Manufacturer newQuery()
 * @method static Builder|Manufacturer query()
 * @method static Builder|Manufacturer whereId($value)
 * @method static Builder|Manufacturer whereName($value)
 * @mixin Eloquent
 */
class Manufacturer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = ['name'];
}
