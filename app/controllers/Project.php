<?php

class Project extends Controller
{
  public function index()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Project";
      $data['projects'] = $this->model('Project_model')->getAllProject($_SESSION['user']);
      $data['users'] = $this->model('User_model')->getAllUserMember();

      $this->view('templates/header', $data);
      $this->view('project/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function data($id)
  {
    $_SESSION['project'] = $id;

    $data['title'] = "Dashboard";
    $data['countProject'] = $this->model('Project_model')->getCountProject($_SESSION['user']);

    $data['totalTestSuites'] = $this->model('Project_model')->getTotalTestSuites($_SESSION['user'], $_SESSION['project']);
    $data['totalTestCases'] = $this->model('Project_model')->getTotalTestCases($_SESSION['user'], $_SESSION['project']);

    $data['countNotSet'] = $this->model('Project_model')->getCountTestCaseNotSet($_SESSION['project'], $_SESSION['user']);
    $data['countHigh'] = $this->model('Project_model')->getCountTestCaseHigh($_SESSION['project'], $_SESSION['user']);
    $data['countMedium'] = $this->model('Project_model')->getCountTestCaseMedium($_SESSION['project'], $_SESSION['user']);
    $data['countLow'] = $this->model('Project_model')->getCountTestCaseLow($_SESSION['project'], $_SESSION['user']);

    $this->view('templates/header', $data);
    $this->view('dashboard/index', $data);
    $this->view('templates/footer', $data);
  }

  public function addAction()
  {
    if ($this->model('Project_model')->insertProject($_POST, $_SESSION['user']) > 0) {
      Flasher::setFlash('success', 'Successfully create project!');
      header("Location:" . BASEURL . "project");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to create project!');
      header("Location:" . BASEURL . "project");
      exit;
    }
  }

  public function memberProject($id)
  {
    $data['project'] = $this->model('Project_model')->getProjectById($id);
    $data['user'] = $this->model('User_model')->getUserMember($data['project']);

    $user = [];
    foreach ($data['user'] as $user) {
      $user[] = "<option value='" . $user['id'] . "'>" . $user['username'] . "</option>";
      echo $user[0];
    }
  }

  public function AddMemberProject()
  {

    $project = $this->model('Project_model')->getProjectById($_POST['id']);
    $userProject = strval($project['user_id']);
    $newUserProject = $userProject . ',' . $_POST['user_id'];

    if ($this->model('Project_model')->AddMemberProject($_POST['id'], $newUserProject) > 0) {
      Flasher::setFlash('success', 'Successfully add new member project!');
      header("Location:" . BASEURL . "project");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to add new member project!');
      header("Location:" . BASEURL . "project");
      exit;
    }
  }

  public function edit($id)
  {
    $data['project'] = $this->model('Project_model')->getProjectById($id);
    $data['projectJson'] = $this->model('Project_model')->getProjectByIdJson($data['project']);
  }

  public function editAction()
  {
    if ($this->model('Project_model')->editProject($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully edit project!');
      header("Location:" . BASEURL . "project");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to edit project!');
      header("Location:" . BASEURL . "project");
      exit;
    }
  }

  public function deleteAction($id)
  {
    if ($this->model('Project_model')->deleteProject($id) > 0) {
      Flasher::setFlash('success', 'Successfully delete project!');
      header("Location:" . BASEURL . "project");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to delete project!');
      header("Location:" . BASEURL . "project");
      exit;
    }
  }
}
