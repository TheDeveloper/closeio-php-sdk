<?php

/**
 * CLOSEIO PHP SDK.
 *
 * Created: July 2013
 * Version: 0.0.1
 */

namespace closeio;

require(dirname(__FILE__).'/Methods.php');
require(dirname(__FILE__).'/routes/Lead.php');

define('CLOSEIO_TRANSPORT_PROTOCOL', 'https');
define('CLOSEIO_HOST', 'app.close.io/api/v1');
if(!defined('CLOSEIO_DEBUG')){
  define('CLOSEIO_DEBUG', false);
}
if(!defined('CLOSEIO_CURL_TIMEOUT')){
  define('CLOSEIO_CURL_TIMEOUT', 2);
}
define('CLOSEIO_CURL', extension_loaded('curl'));

class Closeio{
  public $id;
  public $route = '/';

  function __construct($id = false){
    $this->id = $id;
  }

  function debug($message, $level = E_USER_NOTICE){
    if(!CLOSEIO_DEBUG) return false;
    $message = "[closeio]: $message";
    trigger_error($message, $level);
  }

  function exec($method, $url, $payload){
    if(!CLOSEIO_CURL){
      $this->debug('cURL is required for the CLOSEIO SDK. See http://uk3.php.net/manual/en/book.curl.php for more info.');
      return false;
    }
    if(!defined('CLOSEIO_API_KEY')){
      $this->debug('Closeio API key not defined');
      return false;
    }
    $c = curl_init();

    $this->debug($url, E_USER_NOTICE);
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    if(!in_array($method, array('GET', 'POST'))){
      curl_setopt($c, CURLOPT_CUSTOMREQUEST, $method);
    }
    if($payload){
      curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
      curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-Length: ' . strlen($payload)));
    }
    curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($c, CURLOPT_USERPWD, CLOSEIO_API_KEY . ":");
    curl_setopt($c, CURLOPT_TIMEOUT, CLOSEIO_CURL_TIMEOUT);

    $response = curl_exec($c);
    $error_number = curl_errno($c);
    $error_message = curl_error($c);

    if($error_number){
      $this->debug("cURL encountered error. Code: $error_number. Message: $error_message", E_USER_WARNING);
      return false;
    }

    return $this->validate_response($response);
  }

  function generate_url($route, $params){
    return
      CLOSEIO_TRANSPORT_PROTOCOL . '://' .
      CLOSEIO_HOST .
      $route . '/?' .
      http_build_query($params);
  }

  function validate_response($body){
    if(!$body) return false;
    $body = json_decode($body);

    return $body;
  }

  function send($method, $route, $params = array(), $payload = false){
    $url = $this->generate_url($route, $params);
    return $this->exec($method, $url, $payload);
  }

  function check_payload($payload){
    if(!$payload || !is_object($payload)){
      $this->debug('Tried creating object but no data given', E_USER_WARNING);
      return false;
    }

    if($payload && !is_string($payload)){
      $payload = json_encode($payload);
    }
    return $payload;
  }
}

?>
