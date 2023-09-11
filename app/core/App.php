<?php

class App
{
  protected $controller = 'Signin';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseURL();

    //controller
    if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
      $this->controller = ucfirst($url[0]);
      unset($url[0]);
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    //method
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    // GET params
    if (!empty($url)) {
      $this->params = array_values($url);
    }

    //run controller and method
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseURL()
  {
    return $this->get_url_segments();
  }

  public function get_url_segments(int $segmentIndex = null) {
    // Sample URL
    $url = $_SERVER["REQUEST_URI"];

    // Parse the URL
    $parsed_url = parse_url($url);

    // Extract the path
    $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';

    // Split the path into segments
    $segments = explode('/', trim($path, '/'));

    return !is_null($segmentIndex) ? $segments[$segmentIndex] : $segments;
  }
}
