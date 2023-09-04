<?php

class Project_model extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCountProject($user_id)
  {
    $query = "SELECT COUNT(project.id) AS total_project FROM project WHERE project.user_id LIKE '%" . $user_id . "%';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getTotalTestSuitesUser($user_id)
  {
    $query = "SELECT COUNT(ts.id) AS total_test_suites
              FROM test_suite ts
              INNER JOIN project p ON ts.project_id = p.id
              WHERE p.user_id LIKE '%" . $user_id . "%'";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getTotalTestCasesUser($user_id)
  {
    $query = "SELECT COUNT(tc.id) AS total_test_cases
              FROM test_case tc
              INNER JOIN test_suite ts ON tc.test_suite_id = ts.id
              INNER JOIN project p ON ts.project_id = p.id
              WHERE p.user_id LIKE '%" . $user_id . "%'";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseNotSetUser($user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_not_set FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.priority='Not Set';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseHighUser($user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_high FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.priority='High';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseMediumUser($user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_medium FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.priority='Medium';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseLowUser($user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_low FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.priority='Low';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getTotalTestSuites($user_id, $project_id)
  {
    $query = "SELECT COUNT(ts.id) AS total_test_suites
              FROM test_suite ts
              INNER JOIN project p ON ts.project_id = p.id
              WHERE p.user_id LIKE '%" . $user_id . "%' AND p.id = :project_id";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getTotalTestCases($user_id, $project_id)
  {
    $query = "SELECT COUNT(tc.id) AS total_test_cases
              FROM test_case tc
              INNER JOIN test_suite ts ON tc.test_suite_id = ts.id
              INNER JOIN project p ON ts.project_id = p.id
              WHERE p.user_id LIKE '%" . $user_id . "%' AND p.id = :project_id";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getTotalTestCasesNotSets($user_id)
  {
    $query = "SELECT COUNT(tc.id) AS total_test_cases_not_sets
        FROM test_case tc
        INNER JOIN test_section ts ON tc.test_section_id = ts.id
        INNER JOIN project p ON ts.project_id = p.id
        WHERE p.user_id LIKE '%" . $user_id . "%' AND tc.priority = 'not set'";
    $this->db->query($query);
    $this->db->execute();
    $result = $this->db->resultSingle();
  }

  public function getCountTestSuite($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_suite.id) AS total_test_suite FROM test_suite INNER JOIN project ON test_suite.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_suite.project_id=:project_id;";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCase($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.project_id=:project_id;";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseNotSet($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_not_set FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.project_id=:project_id AND test_case.priority='Not Set';;";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseHigh($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_high FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.project_id=:project_id AND test_case.priority='High';";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseMedium($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_medium FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.project_id=:project_id AND test_case.priority='Medium';";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getCountTestCaseLow($project_id, $user_id)
  {
    $query = "SELECT COUNT(test_case.id) AS total_test_case_low FROM test_case INNER JOIN project ON test_case.project_id=project.id WHERE project.user_id LIKE '%" . $user_id . "%' AND test_case.project_id=:project_id AND test_case.priority='Low';";
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getAllProject($user_id)
  {
    $query = "SELECT project.* FROM project WHERE project.user_id LIKE '%" . $user_id . "%';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getProjectFirst($user_id)
  {
    $query = "SELECT * FROM project WHERE user_id=:user_id LIMIT 1;";
    $this->db->query($query);
    $this->db->bind('user_id', $user_id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getProjectById($id)
  {
    $query = "SELECT * FROM project WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getProjectByIdJson($data)
  {
    return $this->db->jsonResponse($data);
  }

  public function insertProject($data, $user)
  {
    $query = "INSERT INTO project(name,description,user_id) VALUES(:name,:description,:user_id)";
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('user_id', $user);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function AddMemberProject($id, $user_id)
  {
    $query = "UPDATE project SET `user_id`=:user_id WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('user_id', $user_id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function editProject($data)
  {
    $query = "UPDATE project SET `name`=:name,`description`=:description WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteProject($id)
  {
    $query = "DELETE FROM project WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
