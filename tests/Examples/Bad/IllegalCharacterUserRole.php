<?php

namespace SjorsO\Enum\Tests\Examples\Bad;

use SjorsO\Enum\Enum;

class IllegalCharacterUserRole extends Enum
{
    const USER = 'role,user';

    const ADMIN = 'role|admin';
}
