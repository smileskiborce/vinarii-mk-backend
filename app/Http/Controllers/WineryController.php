<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use App\Models\Winery;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class WineryController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = $request->input('query');

        $wineries = Winery::query()
            ->where('legal_name', 'LIKE', '%'.$query.'%')
            ->with('user')
            ->paginate(10);

        return JsonResource::collection($wineries);
    }

    public function show(Winery $winery): JsonResource
    {
        return JsonResource::make($winery);
    }

    public function getWines(Winery $winery): AnonymousResourceCollection
    {
        $wines = Wine::query()
            ->where('winery_id', $winery->id)
            ->paginate(10);

        return JsonResource::collection($wines);
    }
}
