<?php

namespace App\Models;

use App\Enums\Country;
use App\Enums\WineType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Wine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region',
        'vintage',
        'price',
        'wine_type',
        'country',
        'description',
        'alcohol_content',
        'size_liters',
        'winery_id',
        'rating',
        'image',
        'sort',
    ];

    protected $appends = [
        'wine_type_name',
        'country_name',
        'main_image_src',
    ];

    protected $casts = [
        'wine_type' => WineType::class,
        'country' => Country::class,
    ];

    public function wineTypeName(): Attribute
    {
        return Attribute::get(fn () => WineType::name($this->wine_type));
    }

    public function countryName(): Attribute
    {
        return Attribute::get(fn () => Country::name($this->country));
    }

    public function mainImageSrc(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->image));
    }

    public function winery(): BelongsTo
    {
        return $this->belongsTo(Winery::class);
    }

    public function scopeFromAuthWinery(Builder $query): Builder
    {
        $userId = auth()->id();

        return $query->whereHas('winery.user', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        });
    }
}
