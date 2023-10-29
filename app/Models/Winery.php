<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Winery extends Model
{
    use HasFactory;

    protected $fillable = [
        'legal_name',
        'logo_image',
        'cover_image',
        'address',
        'email',
        'phone',
        'description',
        'working_hours',
        'user_id',
    ];

    protected $appends = [
        'logo_image_src',
        'cover_image_src',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function logoImageSrc(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->logo_image));
    }

    public function coverImageSrc(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->cover_image));
    }

    public function scopeFromAuthUser(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }

    public function winerySettings(): HasMany
    {
        return $this->hasMany(WinerySetting::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Winery $winery) {
            if (auth()->check()) {
                $winery->user()->associate(auth()->id());
            }
        });

        self::created(function (Winery $winery) {
            // create settings for every winery
            $settings = WinerySetting::SETTINGS;
            foreach ($settings as $setting) {
                WinerySetting::createSetting($setting, $winery->id);
            }
        });

        self::deleting(function (Winery $winery) {
            $winery->wines()->delete();
        });
    }
}
