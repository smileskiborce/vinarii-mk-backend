<?php

namespace App\Http\Controllers;

use App\Models\Winery;
use App\Models\WinerySetting;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class WinerySettingController extends Controller
{
    public function index(Winery $winery): AnonymousResourceCollection
    {
        $settings = WinerySetting::query()
            ->where('winery_id', $winery->id)
            ->get();

        return JsonResource::collection($settings);
    }
}
