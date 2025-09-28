<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
            allOf: [
        new OAT\Schema(ref: '#/components/schemas/StoreItem'),
        new OAT\Schema(properties: [
            new OAT\Property(property: 'id', type: 'integer', format: 'int64', minimum: 1),
            new OAT\Property(property: 'name', type: 'string', maxLength: 255, example: 'Футболка'),
            new OAT\Property(property: 'descrirpion', type: 'string', nullable: true, example: 'Классная футболка'),
            new OAT\Property(property: 'price', type: 'integer', format: 'int4', minimum: 1),
            new OAT\Property(property: 'image', type: 'string', nullable: true, example: 'images/1.jpg'),
            new OAT\Property(property: 'items_count', type: 'integer', format: 'int4', minimum: 1),
            new OAT\Property(property: 'in_purchases', type: 'boolean'),
            new OAT\Property(property: 'is_active', type: 'boolean'),

            new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
            new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
            new OAT\Property(property: 'deleted_at', type: 'string', format: 'date-time', nullable: true)           
                ]),
            ],
        
    ),
]

class StoreItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $storeItem = $this->resource;
        $data = [
            'id' => $storeItem->id,
            'name' => $storeItem->name,
            'description' => $storeItem->descroption,
            'price' => $storeItem->price,
            'image' => $storeItem->image,
            'items_count' => $storeItem->items_count,
            'created_at' => $storeItem->created_at,
            'updated_at' => $storeItem->updated_at,
            'in_purchases' => $storeItem->in_purchases,
            'is_active' => $storeItem->is_active
        ];

        return $data;
    }
}
