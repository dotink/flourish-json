A basic JSON manipulation class.
============

JSON is a class for instantiation objects which allow you to easily manipulate and compose JSON and JSON serializable objects.  This offers additional functionality over working with `stdClass` objects returned by `json_decode()`.

## Usage

### Creation

You can create a new JSON object in the following manners.

#### Create an Emtpy Object

```php
$json = new JSON();
```
or

```php
$json = new JSON('{}');
```

#### Parse a Full JSON String

```php
$json = new JSON('{
    "firstName": "John",
    "lastName": "Smith",
    "age": 25,
    "address": {
        "streetAddress": "21 2nd Street",
        "city": "New York",
        "state": "NY",
        "postalCode": 10021
    },
    "phoneNumber": [
        {
            "type": "home",
            "number": "212 555-1234"
        },
        {
            "type": "fax",
            "number": "646 555-4567"
        }
    ]
}');
```

#### Use a JSONSerializable Object

```php
$json = new JSON($myJSONSerializable);
```

### Manipulation

Once you have your JSON object you can manipulate it as you would any standard object class, for example:

```php
$json->newProperty = 'value';
```

You can use all the normal PHP functions as well:

```php
if (isset($json->oldProperty)) {
	unset($json->oldProperty);
}
```

#### More Advanced Manipulation

Using the JSON class you can append an object in the same way you can instantiate one.  For example:

```php
$json->existingProperty->append('subProperty', '{
	"field": "value",
	"field2": "another value"
}');
```

#### Removing Properties

Using the `remove()` method you can easily remove sub-properties, array elements, etc, using the same simple syntax:

```php
$json = new JSON('{
	"record_type": "user",
	"user": {
		"name": "Matthew J. Sahagian",
		"addresses": [
			{"street": "1 Main St.", "city": "Sunnyvale", "state": "CA"},
			{"street": "1314 S. Bend Ave", "city": "Mountain View", "state": "CA"}
		]
	}
}');

$json->user->addresses->remove(0);
```

### Composing

Once you're done manipulating your original input, you can go ahead and spit out the new JSON string:

```
$json->compose();
```