<?php

namespace App\Infrastructure\Enum;

use Illuminate\Http\Resources\Json\JsonResource;

class EnumResource extends JsonResource
{
    /**
     * {@inheritDoc}
     */
    public function toArray($request)
    {
        $index = 1;

        foreach ($this->resource as $key => $value) {
            $array[] = (object) ['id' => $index, 'name' => $value, 'value' => $key];

            $index++;
        }

        return $array;
    }
}
