# Xchert Utility Library

Lightweight PHP utility library for structured data handling, JSON operations, reflection helpers, type utilities and
more common tasks.

## Installation

You can install the package via composer:

```bash
composer require xchert/util
```

## Usage

### Value

The `Value` class provides methods for checking and normalizing values.

```php
use Xchert\Util\Value;

// Check if a value is normalized (only contains scalars or arrays of scalars)
Value::isNormalized('foo'); // true
Value::isNormalized(['foo', 'bar']); // true
Value::isNormalized(new \stdClass()); // false

// Check if a value is empty (considers whitespace as empty by default)
Value::isEmpty(''); // true
Value::isEmpty('   '); // true
Value::isEmpty(0); // false
Value::isEmpty(null); // true

// Normalize a value (converts it to a JSON-safe format: arrays and scalars)
$normalized = Value::normalize($someObject);
```

### Type

The `Type` class provides advanced type checking and validation.

```php
use Xchert\Util\Type;

// Get basic type of a value
Type::getType(123); // 'int'
Type::getType([]); // 'array'

// Check if a value matches a specific type (supports classes and interfaces)
Type::is(123, Type::INT); // true
Type::is('123', Type::NUMERIC); // false
Type::is($myObject, MyInterface::class); // true if $myObject implements MyInterface

// Validate a value (throws InvalidTypeException if validation fails)
Type::validate(123, Type::INT); // returns void
Type::validate('foo', Type::INT); // throws InvalidTypeException

// Check if a value is scalar
Type::isScalar(1.5); // true
Type::isScalar([]); // false
```

### Reflection

The `Reflection` class simplifies working with PHP's reflection API, especially when dealing with inheritance.

```php
use Xchert\Util\Reflection;

$reflectionClass = new \ReflectionClass(MyClass::class);

// Get a property, including those from parent classes
$property = Reflection::getProperty($reflectionClass, 'myProperty');

// Get all properties, including those from parent classes
$properties = Reflection::getProperties($reflectionClass);

// Get a method, including those from parent classes
$method = Reflection::getMethod($reflectionClass, 'myMethod');
```

### ArrayUtil

The `ArrayUtil` class provides helper methods for array manipulation.

```php
use Xchert\Util\ArrayUtil;

// Ensure a value is an array
ArrayUtil::ensure('foo'); // ['foo']
ArrayUtil::ensure(['foo']); // ['foo']
ArrayUtil::ensure(null); // []

// Convert any iterable to an array
$array = ArrayUtil::iteratorToArray($myGenerator);

// Deep clone an array (clones objects inside the array)
$clonedArray = ArrayUtil::clone($originalArray);
```