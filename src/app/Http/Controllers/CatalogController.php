<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    )
    {
    }


    public function index(Request $request): View
    {
        $groups = $this->catalogService->getGroupsWithProductCounts();
        $products = $this->catalogService->getAllProductsWithPrice($request);

        return view('catalog.index', compact('groups', 'products'));
    }


    public function group(Request $request, int $id): View
    {
        /** @var Group $group */
        $group = Group::with('children')->findOrFail($id);

        $products = $this->catalogService->getProductsByGroup($request, $group);

        return view('catalog.group', compact('group', 'products'));
    }


    public function product(int $id): View
    {
        /** @var Product $product */
        $product = Product::with(['price', 'group.parent'])->findOrFail($id);

        $breadcrumbs = $this->buildBreadcrumbs($product);

        return view('catalog.product', compact('product', 'breadcrumbs'));
    }


    private function buildBreadcrumbs(Product $product): array
    {
        $breadcrumbs = [];
        $group = $product->group;
        $depth = 0;

        while ($group instanceof Group && $depth++ < 10) {
            $breadcrumbs[] = $group;
            $group = $group->parent;
        }

        return array_reverse($breadcrumbs);
    }
}
