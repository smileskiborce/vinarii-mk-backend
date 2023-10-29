<?php

namespace App\Models;

use App\Traits\HasCaching;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WinerySetting extends Model
{
    use HasFactory, HasCaching;

    protected $fillable = ['value', 'key', 'description', 'winery_id'];

    public $timestamps = false;

    const CONTACT_PHONE = 'contact_phone';

    const CONTACT_EMAIL = 'contact_email';

    const CONTACT_FORM_DESCRIPTION = 'contact_form_description';

    const SETTINGS = [
        [
            'key' => self::CONTACT_PHONE,
            'description' => 'Contact phone',
            'value' => '077xxxxxx',
        ],
        [
            'key' => self::CONTACT_EMAIL,
            'description' => 'Contact email',
            'value' => 'xxx@xxx.com',
        ],
        [
            'key' => self::CONTACT_FORM_DESCRIPTION,
            'description' => 'Contact form description',
            'value' => 'xxxxxxxxxxxxxxxxx',
        ],
    ];

    public function winery(): BelongsTo
    {
        return $this->belongsTo(Winery::class);
    }

    public static function createSetting($setting, $wineryId): Model|Builder
    {
        return WinerySetting::query()->create([
            'key' => $setting['key'],
            'description' => $setting['description'],
            'value' => $setting['value'],
            'winery_id' => $wineryId,
        ]);
    }
}
