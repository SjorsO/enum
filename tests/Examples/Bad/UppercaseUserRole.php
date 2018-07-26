<?php

namespace SjorsO\Enum\Tests\Examples\Bad;

use SjorsO\Enum\Enum;

class UppercaseUserRole extends Enum
{
    const USER = 'Role_user';

    const ADMIN = 'role_admin';
}
