<?php

namespace App\Services;

use App\Models\Price;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductSortService
{
    public function applySorting(Builder $query, Request $request): Builder
    {
        return match ($request->get('sort')) {
            'price_asc' => $query->orderBy('prices.price'),
            'price_desc' => $query->orderByDesc('prices.price'),
            'name_asc' => $query->orderBy('products.name'),
            'name_desc' => $query->orderByDesc('products.name'),
            default => $query,
        };
    }
}
