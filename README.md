Close.io PHP SDK
===

Very simple PHP SDK for [Close.io's](http://close.io) REST API

## Usage

```php
require('closeio-php-sdk/lib/Closeio.php');

$lead_data = new StdClass();
$lead_data->name = "Test User";

$lead = new closeio\Lead();
$lead_data = new StdClass();
$lead_data->name = "Test D00d3";
$result = $lead->create($lead_data);

$lead_id = $result->id;
$lead = new closeio\Lead($lead_id);

$update = new StdClass();
$update->name = 'Test Dood Updated';
$result = $lead->update($update);

$result = $lead->delete();
```