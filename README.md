# Enums

This package holds a simple class that may be use as an ancestor for your
enum classes.

## Usage

Extend the `Greg0ire\Enum\BaseEnum`, define your enum key values as constants,
and Bob's your uncle. You can make the class abstract or final, as you see fit.

```php
use Greg0ire\Enum\BaseEnum;

final class DaysOfWeek extends BasicEnum {
    const Sunday = 0;
    const Monday = 1;
    const Tuesday = 2;
    const Wednesday = 3;
    const Thursday = 4;
    const Friday = 5;
    const Saturday = 6;
}
```

Then, you may use the DaysOfWeek class for input validation:

```php
DaysOfWeek::isValidName('Humpday');                  // false
DaysOfWeek::isValidName('Monday');                   // true
DaysOfWeek::isValidName('monday');                   // true
DaysOfWeek::isValidName('monday', $strict = true);   // false
DaysOfWeek::isValidName(0);                          // false

DaysOfWeek::isValidValue(0);                         // true
DaysOfWeek::isValidValue(5);                         // true
DaysOfWeek::isValidValue(7);                         // false
DaysOfWeek::isValidValue('Friday');                  // false
```

Additionally, you may get all the constants in your class as a hash:

```php
DaysOfWeek::getConstants()
```

## Contributing

see [CONTRIBUTING.md][1]

## Credits

This is a shameless rip-off of [this Stack Overflow answer][0], with one
modification: the `getConstants` method has been made public so that it is
available for building choice widgets, for instance.

[0]: http://stackoverflow.com/a/254543/353612
[1]: ./CONTRIBUTING.md