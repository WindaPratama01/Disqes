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
    // if (empty($_POST['role'])) {
    //   Flasher::setFlash('danger', 'Select role super admin or member first!');
    //   header("Location:" . BASEURL . "signin");
    //   exit;
    // }

    $data['user'] = $this->model('User_model')->getUserSignIn($_POST);

    if ($data['user'] == NULL) {
      Flasher::setFlash('danger', 'Email or Password does not exist!');
      header("Location:" . BASEURL . "signin");
      exit;
    } else {
      $data['project'] = $this->model('Project_model')->getProjectFirst($data['user']['id']);
      $_SESSION['project'] = $data['project']['id'];
      $_SESSION['user'] = $data['user']['id'];

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
