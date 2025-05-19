<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

readonly class CatalogService
{
    public function __construct(
        private ProductSortService         $sortService,
        private GroupProductCounterService $groupCounter
    )
    {
    }


    public function getGroupsWithProductCounts(): Collection
    {
        $groups = Group::with(['children', 'products'])->where('id_parent', 0)->get();
        return $this->groupCounter->appendProductCounts($groups);
    }


    public function getAllProductsWithPrice(Request $request)
    {
        $perPage = $request->integer('per_page', 6);

        $query = Product::join('prices', 'products.id', '=', 'prices.id_product')
            ->select(['products.id', 'products.name', 'prices.price']);

        $query = $this->sortService->applySorting($query, $request);

        return $query->paginate($perPage)
            ->appends($request->only(['sort', 'per_page']));
    }


    public function getProductsByGroup(Request $request, Group $group)
    {
        $perPage = $request->integer('per_page', 6);

        $groupIds = $group->children->pluck('id')->push($group->id);

        $query = Product::whereIn('id_group', $groupIds)->with('price');

        $query = $this->sortService->applySorting($query, $request);

        return $query->paginate($perPage)
            ->appends($request->only(['sort', 'per_page']));
    }
}
