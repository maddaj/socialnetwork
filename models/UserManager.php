<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM user WHERE id = :id ");
  $response->execute(
    array(
      "id" => $id
    )
  );
  return $response->fetchAll();
}

function GetAllUsers()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user ORDER BY nickname ASC");
  return $response->fetchAll();
}

function GetUserIdFromUserAndPassword($username, $password)
{
  global $PDO;
  $preparedRequest = $PDO->prepare("SELECT * FROM user WHERE nickname = :nickname AND password = :password");
  $preparedRequest->execute(
    array(
      "nickname" => $username,
      "password" => $password
    )
  );
  $users = $preparedRequest->fetchAll();
  return count($users) == 1;
}

function IsNicknameFree($nickname)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM user WHERE nickname = :nickname ");
  $response->execute(
    array(
      "nickname" => $nickname
    )
  );
  return $response->rowCount() == 0;
}

function CreateNewUser($nickname, $password)
{
  global $PDO;
  $response = $PDO->prepare("INSERT INTO user (nickname, password) values (:nickname , :password )");
  $response->execute(
    array(
      "nickname" => $nickname,
      "password" => $password
    )
  );
  return $PDO->lastInsertId();
}
