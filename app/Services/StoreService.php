<?php

namespace App\Services;

use App\Models\StoreItem;
use Illuminate\Pagination\LengthAwarePaginator;

class StoreService
{
    public function index(?int $page = null, ?int $perPage = null, $in_storage = false, $only_available = false) : LengthAwarePaginator {
        $builder = StoreItem::orderBy('id');
        if ($in_storage) {
            $builder = auth()->user()->storeItems();
        } else {
            if ($only_available) {
                $builder->where('items_count', '>', 0)->where('is_available', true);
            }
        }

        return $builder->paginate(perPage: $perPage, page: $page);
    }

    public function buyItem(StoreItem $storeItem) : void {
        auth()->user()->storeItems()->attach($storeItem->id);
        auth()->user()->gold -= $storeItem->price;
        auth()->user()->save();
    }
}
