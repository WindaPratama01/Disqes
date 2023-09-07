<?php

class TestCase extends Controller
{
  public function index()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Test Case";
      $data['url_add_case'] = [];
      $data['title_case'] = 'All Test Cases';
      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);
      $data['test_sections'] = [];
      $data['test_cases'] = $this->model('Testcase_model')->getTestCase($_SESSION['project']);

      $this->view('templates/header', $data);
      $this->view('test-case/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  // method export file sesuai project
  public function exportFileByProject($project_id)
  {
      $filename = 'disqes_test_cases_' . date('Ymd') . '.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // Mengambil semua test case yang terkait dengan project_id tertentu
      $testCases = $this->model('Testcase_model')->getTestCase($project_id);

      $file = fopen('php://output', 'w');
      $header = array("ID", "Name", "Key Case", "Priority", "Behavior", "Precondition", "Instruction", "Expected Result");
      fputcsv($file, $header);

      foreach ($testCases as $testCase) {
          $line = array(
              $testCase['id'],
              $testCase['name'],
              $testCase['key_case'],
              $testCase['priority'],
              $testCase['behavior'],
              $testCase['precondition'],
              $testCase['instruction'],
              $testCase['expected_result']
          );
          fputcsv($file, $line);
      }

      fclose($file);
      exit;
  }

  public function project($project_id)
  {
    $_SESSION['project'] = $project_id;
    header("Location:" . BASEURL . "testcase");
    exit;
  }

  public function filterTestCase()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Test Case";
      $data['url_add_case'] = [];
      $data['title_case'] = 'All Test Cases';
      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);
      $data['test_sections'] = [];

      $data['test_cases'] = $this->model('Testcase_model')->getTestCaseByFilter($_POST);
      $data['filterName'] = $_POST['name'];

      $this->view('templates/header', $data);
      $this->view('test-case/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function addTestSuiteAction()
  {
    if ($this->model('Testsuite_model')->insertTestSuite($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully create test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to create test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function editTestSuite($id)
  {
    $data['test_suite'] = $this->model('Testsuite_model')->getTestSuiteById($id);
    $data['test_suiteJson'] = $this->model('Testsuite_model')->getTestSuiteByIdJson($data['test_suite']);
  }

  public function editTestSuiteAction()
  {
    if ($this->model('Testsuite_model')->editTestSuite($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully edit test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to edit test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function deleteTestSuiteAction($id)
  {
    if ($this->model('Testsuite_model')->deleteTestSuite($id) > 0) {
      Flasher::setFlash('success', 'Successfully delete test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to delete test suite!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function testsuite($test_suite_id)
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Test Case";
      $data['url_add_case'] = [];
      $data['test_suite'] = $this->model('Testsuite_model')->getTestSuiteById($test_suite_id);
      $data['title_case'] = $data['test_suite']['name'];
      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);
      $data['test_sections'] = $this->model('Testsection_model')->getTestSectionByTestSuiteId($test_suite_id);
      $data['test_cases'] = $this->model('Testcase_model')->getTestCaseByTestSuiteId($test_suite_id, $_SESSION['project']);

      $this->view('templates/header', $data);
      $this->view('test-case/index', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function addTestSectionAction()
  {
    if ($this->model('Testsection_model')->insertTestSection($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully create test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to create test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function editTestSection($id)
  {
    $data['test_section'] = $this->model('Testsection_model')->getTestSectionById($id);
    $data['test_sectionJson'] = $this->model('Testsection_model')->getTestSectionByIdJson($data['test_section']);
  }

  public function editTestSectionAction()
  {
    if ($this->model('Testsection_model')->editTestSection($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully edit test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to edit test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function deleteTestSectionAction($id)
  {
    if ($this->model('Testsection_model')->deleteTestSection($id) > 0) {
      Flasher::setFlash('success', 'Successfully delete test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to delete test section!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function testsection($test_suite_id, $test_section_id)
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Test Case";
      $data['url_add_case'] = $test_suite_id . '/' . $test_section_id;
      $data['test_suite'] = $this->model('Testsuite_model')->getTestSuiteById($test_suite_id);
      $data['test_section'] = $this->model('Testsection_model')->getTestSectionById($test_section_id);
      $data['title_case'] = $data['test_suite']['name'] . ' | ' . $data['test_section']['name'];

      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);

      $test_section = array();
      foreach ($data['test_suites'] as $test_suite) {
        array_push($test_section, $this->model('Testsection_model')->getTestSectionByTestSuiteId($test_suite['id']));
      }

      $data['test_sections'] = $this->model('Testsection_model')->getTestSectionByTestSuiteId($test_suite_id);
      $data['test_cases'] = $this->model('Testcase_model')->getTestCaseByTestSectionId($test_suite_id, $test_section_id, $_SESSION['project']);

      $this->view('templates/header', $data);
      $this->view('test-case/index', $data, $test_section);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function addTestCase()
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "New Test Case";
      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);

      $this->view('templates/header', $data);
      $this->view('test-case/add', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function getAllTestSection($test_suite)
  {
    $data['test_sections'] = $this->model('Testsection_model')->getTestSectionByProjectId($_SESSION['project'], $test_suite);

    $test_section = [];
    foreach ($data['test_sections'] as $test_section) {
      $test_section[] = "<option value='" . $test_section['id'] . "'>" . $test_section['name'] . "</option>";
      echo $test_section[0];
    }
  }

  public function addTestCaseAction()
  {
    if ($_POST['name'] == '' || $_POST['test_section_id'] == '-' || $_POST['precondition'] == '') {
      Flasher::setFlash('danger', 'Input data correctly!');
      header("Location:" . BASEURL . "testcase/addTestCase");
      exit;
    } else {
      $_POST['instruction'] = implode(',', $_POST['instruction']);
      $_POST['expected_result'] = implode(',', $_POST['expected_result']);

      $data['test_suite'] = $this->model('Testsuite_model')->getTestSuiteById($_POST['test_suite_id']);
      $data['test_section'] = $this->model('Testsection_model')->getTestSectionById($_POST['test_section_id']);
      $data['test_case'] = $this->model('Testcase_model')->getTestCaseLatestId();

      $firstLetterTestSuite = substr($data['test_suite']['name'], 0, 1);
      $firstLetterTestSection = substr($data['test_section']['name'], 0, 1);
      $randomKey = '';

      if ($data['test_case']) {
        $randomKey = $data['test_case']['totalTestCase'] + 1;
      } else {
        $randomKey = 1;
      }

      $_POST['key_case'] = $firstLetterTestSuite . $firstLetterTestSection . '-' . $randomKey;
      $_POST['project_id'] = $_SESSION['project'];

      if ($this->model('Testcase_model')->insertTestCase($_POST) > 0) {
        Flasher::setFlash('success', 'Successfully create test case!');
        header("Location:" . BASEURL . "testcase");
        exit;
      } else {
        Flasher::setFlash('danger', 'Failed to create test case!');
        header("Location:" . BASEURL . "testcase");
        exit;
      }
    }
  }

  public function editTestCase($id)
  {
    if (isset($_SESSION['username'])) {
      $data['title'] = "Edit Test Case";
      $data['test_case'] = $this->model('Testcase_model')->getTestCaseById($id);

      $data['test_case']['instruction'] = explode(',', $data['test_case']['instruction']);
      $data['test_case']['expected_result'] = explode(',', $data['test_case']['expected_result']);

      $data['test_suites'] = $this->model('Testsuite_model')->getTestSuiteByProjectId($_SESSION['project']);

      $this->view('templates/header', $data);
      $this->view('test-case/edit', $data);
      $this->view('templates/footer', $data);
    } else {
      header("Location:" . BASEURL . "signin");
      exit;
    };
  }

  public function editTestCaseAction()
  {
    $_POST['instruction'] = implode(',', $_POST['instruction']);
    $_POST['expected_result'] = implode(',', $_POST['expected_result']);

    if ($this->model('Testcase_model')->editTestCase($_POST) > 0) {
      Flasher::setFlash('success', 'Successfully edit test case!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to edit test case!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }

  public function deleteTestCaseAction($id)
  {
    if ($this->model('Testcase_model')->deleteTestCase($id) > 0) {
      Flasher::setFlash('success', 'Successfully delete test case!');
      header("Location:" . BASEURL . "testcase");
      exit;
    } else {
      Flasher::setFlash('danger', 'Failed to delete test case!');
      header("Location:" . BASEURL . "testcase");
      exit;
    }
  }
}
