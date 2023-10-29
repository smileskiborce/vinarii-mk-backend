<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class WineController extends Controller
{
    public function show(Wine $wine): JsonResource
    {
        return JsonResource::make($wine);
    }

    public function getBestWines(): AnonymousResourceCollection
    {
        $bestWines = Wine::query()
            ->inRandomOrder()
            ->paginate(12);

        return JsonResource::collection($bestWines);
    }
}
