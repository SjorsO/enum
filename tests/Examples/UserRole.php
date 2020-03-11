<?php

namespace SjorsO\Enum\Tests\Examples;

use SjorsO\Enum\Enum;

class UserRole extends Enum
{
    const USER = 'role_user';

    const ADMIN = 'role_admin';

    private const NOT_THIS_ONE = 'private_value';

    protected const ALSO_NOT_THIS_ONE = 'protected_value';
}
