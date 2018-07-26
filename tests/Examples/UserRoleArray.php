<?php

namespace SjorsO\Enum\Tests\Examples;

use SjorsO\Enum\EnumArray;

class UserRoleArray extends EnumArray
{
    const VALUES = [
        'USER'  => 'role_user',
        'ADMIN' => 'role_admin',
    ];
}
