<?php

namespace SjorsO\Enum\Tests\Examples\Bad;

use SjorsO\Enum\Enum;

class DuplicateUserRole extends Enum
{
    const USER = 'role_user';

    const ADMIN = 'role_user';
}
