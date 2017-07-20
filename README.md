Laravel Mutable
===============

> Change Laravel models `toArray()` values using a simple and clean way

# Installation

```
composer require jgrossi/laravel-mutable
```

## Usage

First add `Mutable` trait to the model you want to change values:

```php
use Jgrossi\Mutable\Mutable;

class User extends Eloquent
{
    use Mutable;
}
```

Then create a `UserMutator` class in any place in your app (or give it other name if you prefer). Then set the `$mutator` property in your model:

```php
use App\Models\Mutators\UserMutator;
use Jgrossi\Mutable\Mutable;

class User extends Eloquent
{
    use Mutable;

    protected $mutator = UserMutator::class;
}
```

In your mutator class you might have one method for each attribute you want to change:

```php
namespace App\Models\Mutators;

use Jgrossi\Mutable\Mutator;

class UserMutator extends Mutator
{
    public function firstName($value)
    {
        return ucfirst($value);
    }

    public function createdAt($value)
    {
        return $value->format('Y-m-d');
    }
}
```

Then when using `$user->toArray()` you'll have the `first_name` attributes changed.

```php
class FooController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user; // returns the changed User as array
    }
}
```

# <a id="license"></a> Licence

[MIT License](http://jgrossi.mit-license.org/) © Junior Grossi
