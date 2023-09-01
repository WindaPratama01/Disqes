<?php

class Dashboard extends Controller
{
  public function index()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Dashboard";
      $data['countProject'] = $this->model('Project_model')->getCountProject($_SESSION['user']);
      
      // code dashboard page global
      $data['totalTestSuites'] = $this->model('Project_model')->getTotalTestSuites($_SESSION['user']);
      $data['totalTestCases'] = $this->model('Project_model')->getTotalTestCases($_SESSION['user']);
      $data['totalNotSet'] = $this->model('Project_model')->getTotalTestCaseNotSet($_SESSION['user']);
      $data['totalHigh'] = $this->model('Project_model')->getTotalTestCaseHigh($_SESSION['user']);
      $data['totalMedium'] = $this->model('Project_model')->getTotalTestCaseMedium($_SESSION['user']);
      $data['totalLow'] = $this->model('Project_model')->getTotalTestCaseLow($_SESSION['user']);

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }
}
