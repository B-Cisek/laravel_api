<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{

    public function toArray($request): array|Arrayable
    {
        return parent::toArray($request);
    }
}
