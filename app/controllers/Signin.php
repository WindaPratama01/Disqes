<?php

class Signin extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['username'])) {
      $data['title'] = "Signin";
      $this->view('signin/index', $data);
    } else {
      header("Location:" . BASEURL . "dashboard");
      exit;
    };
  }

  public function signInAction()
  {
    $data['user'] = $this->model('User_model')->getUserSignIn($_POST);

    if ($data['user'] == NULL) {
      Flasher::setFlash('danger', 'Email or Password does not exist!');
      header("Location:" . BASEURL . "signin");
      exit;
    } else {
      $data['project'] = $this->model('Project_model')->getProjectFirst($data['user']['id']);
      $_SESSION['project'] = $data['project']['id'];
      $_SESSION['user'] = $data['user']['id'];
      $_SESSION['role'] = $data['user']['role'];

      $_SESSION['username'] = $data['user']['username'];
      header("Location:" . BASEURL . "dashboard");
      exit;
    }
  }

  public  function logout()
  {
    unset($_SESSION['username']);
    session_destroy();
    header("Location:" . BASEURL . "signin");
    exit;
  }
}
