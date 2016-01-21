# Modulus11

Modulus11 algorithm implementation for PHP. The Modulus11 algorithm is used in some bank account numbers and national identity numbers.

## Installation

To add this package as a dependency to your project, simply add a dependency on `komakino/modulus11` to your project's `composer.json` file.
```json
    {
        "require": {
            "komakino/modulus11": "*"
        }
    }
```
### Usage

```php
use Komakino\Modulus11\Modulus11;
```
#### Factors
The standard factors for Modulus11 calculations are [2,3,4,5,6,7], looped. In some cases other factors are used. If your implementation requires custom factors, simply supply them as a second argument to any method.

#### Static methods

*static* bool **validate**(*string*|*int* $number, *array* $factors = null)

Validates a number.
```php
Modulus11::validate('11223344'); // returns false
Modulus11::validate('12345674'); // returns true
```

*static* int **calculate**(*string*|*int* $partial_number, *array* $factors = null)

Calculates the check digit of a number.
```php
Modulus11::calculate('1122334'); // returns 6
Modulus11::calculate('1234567'); // returns 4
```

*static* string **appendCheckDigit**(*string*|*int* $partial_number, *array* $factors = null)

Calculates the check digit and returns number with check digit appended.
```php
Modulus11::appendCheckDigit('1122334'); // returns 11223346
Modulus11::appendCheckDigit('1234567'); // returns 12345674
```
