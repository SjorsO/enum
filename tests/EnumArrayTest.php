<?php

namespace SjorsO\Enum\Tests;

use SjorsO\Enum\EnumArray;
use SjorsO\Enum\Tests\Examples\UserRoleArray;

class EnumArrayTest extends EnumTest
{
    /** @var $userRole EnumArray */
    protected $userRole;

    protected function setUp()
    {
        parent::setUp();

        $this->userRole = UserRoleArray::class;
    }

    /** @test */
    function all_the_values_are_a_single_constant()
    {
        $this->assertSame([
            'USER'  => 'role_user',
            'ADMIN' => 'role_admin',
        ], $this->userRole::VALUES);
    }
}
