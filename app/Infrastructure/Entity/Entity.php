<?php

namespace App\Infrastructure\Entity;

use BadMethodCallException;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Entity extends DataTransferObject
{
    /**
     * Create a new instance class in static way.
     *
     * @param  array  $parameters
     * @return static
     */
    public static function make(array $parameters = [])
    {
        return new static($parameters);
    }

    /**
     * Convert entity into model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws Exception
     */
    public function toModel()
    {
        throw new BadMethodCallException('This class [' . static::class . '] doesn\'t implement Method toModel()');
    }
}
