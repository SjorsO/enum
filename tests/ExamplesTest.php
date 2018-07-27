<?php

namespace SjorsO\Enum\Tests;

use PHPUnit\Framework\TestCase;
use SjorsO\Enum\Tests\Examples\Bad\DuplicateUserRole;
use SjorsO\Enum\Tests\Examples\Bad\IllegalCharacterUserRole;
use SjorsO\Enum\Tests\Examples\Bad\UppercaseUserRole;
use SjorsO\Enum\Tests\Examples\UserRole;

class ExamplesTest extends TestCase
{
    /**
     *
     * These tests are for examples listed in the readme
     *
     */

    /** @test */
    function all_values_are_unique()
    {
        $this->assertTrue(
            UserRole::values()->all() === UserRole::values()->unique()->all(),
            'Not all enum values are unique'
        );
    }

    /** @test */
    function the_example_test_fails_if_all_values_are_not_unique()
    {
        $this->assertFalse(
            DuplicateUserRole::values()->all() === DuplicateUserRole::values()->unique()->all()
        );
    }

    /** @test */
    function all_values_should_be_lowercase()
    {
        $allValues = UserRole::values();

        $lowercaseValues = $allValues->filter(function (string $value) {
            return strtolower($value) === $value;
        })->values()->all();

        $this->assertTrue(
            $allValues->all() === $lowercaseValues,
            'Enum values should all be lowercase'
        );
    }

    /** @test */
    function the_example_test_fails_if_values_are_not_all_lowercase()
    {
        $allValues = UppercaseUserRole::values();

        $lowercaseValues = $allValues->filter(function (string $value) {
            return strtolower($value) === $value;
        })->values()->all();

        $this->assertFalse(
            $allValues->all() === $lowercaseValues
        );
    }

    /** @test */
    function values_should_not_contain_commas_or_pipes()
    {
        $allValues = UserRole::values();

        $goodValues = $allValues->filter(function (string $value) {
            return strpos($value, ',') === false && strpos($value, '|') === false;
        })->values()->all();

        $this->assertTrue(
            $allValues->all() === $goodValues,
            'Enum values should not contain commas or pipes'
        );
    }

    /** @test */
    function the_example_test_fails_if_values_contain_commas_or_pipes()
    {
        $allValues = IllegalCharacterUserRole::values();

        $goodValues = $allValues->filter(function (string $value) {
            return strpos($value, ',') === false && strpos($value, '|') === false;
        })->values()->all();

        $this->assertFalse(
            $allValues->all() === $goodValues
        );
    }
}
