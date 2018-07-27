# Enum
A useful abstract class for making enums in Laravel.

## Install
```bash
composer require sjorso/enum
```

## Creating enums
You can create an enum like this:
```php
class UserRole extends Enum
{
    const USER = 'role_user';

    const ADMIN = 'role_admin';
}
```

## Using enums
You can access the values of the enum in your code:
```php
if ($user->role !== UserRole::ADMIN) {
    abort(401);
}
```

You can pass enum values to a view like this:
```php
return view('admin.user.edit', [    
    'roles' => UserRole::values(), // returns a Collection
]);
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
return UserRole::apiResource(); 
```

There are two methods for checking if an enum value is valid:
```php
UserRole::has('role_user'); // true
UserRole::has('wrong_role'); // false

UserRole::assert('role_user'); // returns void
UserRole::assert('wrong_role'); // throws a RunTimeException
```

## Enum arrays
This package also contains an abstract `EnumArray` class. The `EnumArray` class extends the `Enum` class. When using an enum array you can't access individual constants, but all the static methods still work. 

You can create an enum array like this:
```php
class Timezone extends EnumArray
{
    const VALUES = [
        'Africa/Abidjan',
        'Africa/Accra',
        'Africa/Addis_Ababa',
        'Africa/Algiers',
        'Africa/Asmara',
        'Africa/Bamako',
        // etc..
    ];
}
```

## Tests
To make sure your enums work like you expect, you can create a unit test for each enum class you create. The tests below could prevent some headaches: 

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
