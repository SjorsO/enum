# Enum
A useful abstract class for making enums in Laravel.

## Install
```bash
composer require sjorso/enum
```

## Creating enums
This package contains two abstract classes: `Enum` and `EnumArray`. They make it easy to define enums and have static methods that make using them simple.

You can create an enum like this:
```php
class UserRole extends Enum
{
    const USER = 'role_user';

    const ADMIN = 'role_admin';
}
```

The `EnumArray` class extends the `Enum` class, it differs in that it reads its values from a key value array. All other methods of the `EnumArray` work the same as the `Enum` class.

You can create an enum using the `EnumArray` class like this:
```php
class UserRoleArray extends EnumArray
{
    const VALUES = [
        'USER'  => 'role_user',
        'ADMIN' => 'role_admin',
    ];
}
```

## Using enums
You can easily access the constants of the enum in your code. For example, you can use the following code in a middleware:
```
if ($user->role !== UserRole::ADMIN) {
    abort(401);
}

return $next($request);
```

The `Enum` class has two useful methods for generating validation rules:
```php
$request->validate([
    'role' => UserRole::required(), // 'required|in:role_user,role_admin'    
    'role' => UserRole::optional(), // 'in:role_user,role_admin'    
]);
```

If you want to return an enum in an api response, you can do the following:
```php
// returns an "Illuminate\Http\Resources\Json\JsonResource" containing the enum values
return UserRole::apiResponse(); 
```

There are two methods for checking if an enum value is valid:
```php
UserRole::has('role_user'); // true
UserRole::has('wrong_role'); // false

UserRole::assert('role_user'); // returns void
UserRole::assert('wrong_role'); // throws a RunTimeException
```

## Tests
To make sure your enums work like you expect, you can create a unit test for each enum class you create. The tests below could prevent some headaches and lost time: 

```php
/** @test */
function all_values_are_unique()
{
    $this->assertSame(
        UserRole::values()->all(),
        UserRole::values()->unique()->all(),
        'Not all enum values are unique'
    );
}

/** @test */
function all_values_should_be_lowercase()
{
    $allValues = UserRole::values();

    $lowercaseValues = $allValues->filter(function (string $value) {
        return strtolower($value) === $value;
    })->values()->all();

    $this->assertSame(
        $allValues->all(),
        $lowercaseValues,
        'Enum values should all be lowercase'
    );
}

/** @test */
function values_should_not_contain_commas_or_pipes()
{
    // Commas or pipes will break the "required()" and "optional()" validation rules.
    $allValues = UserRole::values();

    $goodValues = $allValues->filter(function (string $value) {
        return strpos($value, ',') === false && strpos($value, '|') === false;
    })->values()->all();

    $this->assertSame(
        $allValues->all(),
        $goodValues,
        'Enum values should not contain commas or pipes'
    );
}
```

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
