<?php

namespace SjorsO\Enum\Tests\Examples;

use SjorsO\Enum\Enum;

class NumericEnum extends Enum
{
    const ZERO = 0;

    const ONE = 1;

    protected const NOT_THIS_ONE = 2;

    private const ALSO_NOT_THIS_ONE = 3;
}
