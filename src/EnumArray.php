<?php

namespace SjorsO\Enum;

use Illuminate\Support\Collection;

abstract class EnumArray extends Enum
{
    public static function all()
    {
        return new Collection(static::VALUES);
    }
}
