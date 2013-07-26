<?php

namespace closeio;

class Methods extends Closeio {

  function create($payload){
    $method = 'POST';
    $payload = $this->check_payload($payload);

    return $this->send($method, $this->route, false, $payload);
  }

  function read($params){
    $method = 'GET';

    return $this->send($method, $this->route, $params);
  }

  function update($payload, $params = array()){
    $method = 'PUT';

    $payload = $this->check_payload($payload);

    return $this->send($method, $this->route . '/' . $this->id, $params, $payload);
  }

  function delete(){
    $method = 'DELETE';

    return $this->send($method, $this->route . '/' . $this->id);
  }
}

?>
