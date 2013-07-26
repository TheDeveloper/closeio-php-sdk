#!/usr/bin/env php

<?php
/**
 * Super bare-bones test
 */
error_reporting(E_ALL);
define('CLOSEIO_DEBUG', true);
define('CLOSEIO_API_KEY', getenv('CLOSEIO_API_KEY'));
require(__DIR__ . '/../lib/Closeio.php');

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
?>
