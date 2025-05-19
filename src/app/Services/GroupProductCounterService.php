<?php

namespace App\Services;

use App\Models\Group;
use Illuminate\Support\Collection;

class GroupProductCounterService
{
    public function appendProductCounts(Collection $groups): Collection
    {
        return $groups->map(function (Group $group) {
            $group->loadMissing(['children', 'products']);

            $group->total_products = $group->products->count() +
                $this->countSubgroupProducts($group->children);

            if ($group->children->isNotEmpty()) {
                $group->children = $this->appendProductCounts($group->children);
            }

            return $group;
        });
    }


    private function countSubgroupProducts(Collection $children): int
    {
        return $children->sum(function (Group $child) {
            $child->loadMissing(['children', 'products']);

            return $child->products->count() +
                ($child->children->isNotEmpty()
                    ? $this->countSubgroupProducts($child->children)
                    : 0);
        });
    }
}
