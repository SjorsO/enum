<?php

namespace SjorsO\Enum;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use ReflectionClass;
use RuntimeException;

abstract class Enum
{
    private function __construct()
    {
        //
    }

    public static function all()
    {
        $reflection = new ReflectionClass(static::class);

        $constants = $reflection->getConstants();

        return new Collection($constants);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function values()
    {
        return static::all()->values();
    }

    public static function has($string): bool
    {
        return static::all()->contains($string);
    }

    public static function required()
    {
        return 'required|'.static::optional();
    }

    public static function optional()
    {
        return 'in:'.static::all()->implode(',');
    }

    public static function apiResource()
    {
        return new JsonResource(
            self::values()
        );
    }

    public static function assert($string)
    {
        if (! static::has($string)) {
            throw new RuntimeException('Not a valid '.static::class.' enum: '.$string);
        }

        return $string;
    }
}
