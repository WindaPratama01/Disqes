<?php

class User_model extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserSignIn($data)
  {
    $query = "SELECT * FROM user WHERE email=:email && password=:password";
    $this->db->query($query);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function getAllUserMember()
  {
    $query = "SELECT * FROM user WHERE role='member';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getAllUserMemberJson($data)
  {
    return $this->db->jsonResponse($data);
  }

  public function getUserMember($data)
  {
    $query = "SELECT * FROM user WHERE user.id NOT IN (" . $data['user_id'] . ") AND role='member';";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function insertUserSignup($data)
  {
    $query = "INSERT INTO user(username,email,password,role) VALUES(:username,:email,:password,:role)";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('role', $data['role']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getUserByEmail($data)
  {
    $query = "SELECT * FROM user WHERE email=:email";
    $this->db->query($query);
    $this->db->bind('email', $data['email']);
    $this->db->execute();
    return $this->db->resultSingle();
  }

  public function changePasswordUser($data, $id)
  {
    $query = "UPDATE user SET `password`=:password WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('password', $data['password']);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
