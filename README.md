Close.io PHP SDK
===

Very simple PHP SDK for [Close.io's](http://close.io) REST API

## Usage

```php
define('CLOSEIO_DEBUG', true);
// Define CLOSEIO_API_KEY in your env or place as the value here
define('CLOSEIO_API_KEY', getenv('CLOSEIO_API_KEY'));

require('closeio-php-sdk/lib/Closeio.php');

$lead_data = new StdClass();
$lead_data->name = "Test User";

$lead = new Closeio\Lead();
$lead_data = new StdClass();
$lead_data->name = "Test D00d3";
$result = $lead->create($lead_data);

$lead_id = $result->id;
$lead = new Closeio\Lead($lead_id);

$update = new StdClass();
$update->name = 'Test Dood Updated';
$result = $lead->update($update);

$result = $lead->delete();
```

## TODO

Currently, only the leads route of the API has been implemented.

It is easy to add other API routes to the SDK. Have a look at the [Leads](https://github.com/TheDeveloper/closeio-php-sdk/blob/master/lib/routes/Lead.php) class to see how this is done. PR's welcome :)
