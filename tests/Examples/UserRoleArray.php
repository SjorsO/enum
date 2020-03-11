<?php

namespace SjorsO\Enum\Tests\Examples;

use SjorsO\Enum\EnumArray;

class UserRoleArray extends EnumArray
{
    const VALUES = [
        'USER'  => 'role_user',
        'ADMIN' => 'role_admin',
    ];

    private const NOT_THIS_ONE = 'private_value';

    protected const ALSO_NOT_THIS_ONE = 'protected_value';
}
