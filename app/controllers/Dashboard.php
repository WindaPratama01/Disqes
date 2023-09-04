<?php

class Dashboard extends Controller
{
  public function index()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Dashboard";
      $data['countProject'] = $this->model('Project_model')->getCountProject($_SESSION['user']);

      $data['totalTestSuites'] = $this->model('Project_model')->getTotalTestSuitesUser($_SESSION['user']);
      $data['totalTestCases'] = $this->model('Project_model')->getTotalTestCasesUser($_SESSION['user']);

      $data['countNotSet'] = $this->model('Project_model')->getCountTestCaseNotSetUser($_SESSION['user']);
      $data['countHigh'] = $this->model('Project_model')->getCountTestCaseHighUser($_SESSION['user']);
      $data['countMedium'] = $this->model('Project_model')->getCountTestCaseMediumUser($_SESSION['user']);
      $data['countLow'] = $this->model('Project_model')->getCountTestCaseLowUser($_SESSION['user']);

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }
}
