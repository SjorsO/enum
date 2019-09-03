<?php

namespace SjorsO\Enum\Tests;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use SjorsO\Enum\Enum;
use SjorsO\Enum\Tests\Examples\UserRole;

class EnumTest extends TestCase
{
    /** @var $userRole Enum */
    protected $userRole;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRole = UserRole::class;
    }

    /** @test */
    function it_can_get_the_underlying_values()
    {
        $values = $this->userRole::all();

        $this->assertInstanceOf(Collection::class, $values);

        $this->assertSame([
            'USER'  => 'role_user',
            'ADMIN' => 'role_admin',
        ], $values->all());
    }

    /** @test */
    function it_can_get_the_values()
    {
        $values = $this->userRole::values();

        $this->assertInstanceOf(Collection::class, $values);

        $this->assertSame([
            'role_user',
            'role_admin',
        ], $values->all());
    }

    /** @test */
    function it_can_tell_if_an_enum_value_exists()
    {
        $this->assertTrue(
            $this->userRole::has('role_admin')
        );

        $this->assertFalse(
            $this->userRole::has('role_unknown')
        );
    }

    /** @test */
    function enum_values_are_case_sensitive()
    {
        $this->assertFalse(
            $this->userRole::has('Role_admin')
        );
    }

    /** @test */
    function it_can_make_a_required_validation_rule()
    {
        $rule = $this->userRole::required();

        $this->assertSame('required|in:role_user,role_admin', $rule);
    }

    /** @test */
    function it_can_make_a_optional_validation_rule()
    {
        $rule = $this->userRole::optional();

        $this->assertSame('in:role_user,role_admin', $rule);
    }

    /** @test */
    function it_can_make_an_api_resource()
    {
        $resource = $this->userRole::apiResource();

        $this->assertInstanceOf(JsonResource::class, $resource);

        $this->assertSame([
            'role_user',
            'role_admin',
        ], $resource->toArray(null));
    }

    /** @test */
    function it_can_assert_that_a_value_exists()
    {
        $returnValue = $this->userRole::assert('role_admin');

        $this->assertSame('role_admin', $returnValue);
    }

    /** @test */
    function it_throws_an_exception_when_the_assertion_fails()
    {
        $this->expectExceptionMessageRegExp('/ enum: role_unknown/');

        $this->userRole::assert('role_unknown');

        $this->fail('Excepted a RunTimeException to be thrown');
    }
}
