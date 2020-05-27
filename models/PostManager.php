<?php
include_once "PDO.php";

function GetOnePostFromId($id)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM post WHERE id = :id ");
  $response->execute(
    array(
      "id" => $id
    )
  );
  return $response->fetchAll();
}

function GetAllPosts()
{
  global $PDO;
  $response = $PDO->query(
    "SELECT post.*, user.nickname "
      . "FROM post LEFT JOIN user on (post.user_id = user.id) "
      . "ORDER BY post.created_at DESC"
  );
  return $response->fetchAll();
}

function GetAllPostsFromUserId($userId)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM post WHERE user_id = :id ORDER BY created_at DESC");
  $response->execute(
    array(
      "id" => $userId
    )
  );
  return $response->fetchAll();
}

function SearchInPosts($search)
{
  global $PDO;
  $response = $PDO->prepare(
    "SELECT post.*, user.nickname "
      . "FROM post LEFT JOIN user on (post.user_id = user.id) "
      . "WHERE content like :search "
      . "ORDER BY post.created_at DESC"
  );
  $searchWithPercent = "%$search%";
  $response->execute(
    array(
      "search" => $searchWithPercent
    )
  );
  return $response->fetchAll();
}

function CreateNewPost($userId, $msg)
{
  global $PDO;
  if (!empty($userId) && !empty($msg)) {
    $response = $PDO->prepare("INSERT INTO post(user_id, content) values (:userId, :msg)");
    $response->execute(
      array(
        "userId" => $userId,
        "msg" => $msg
      )
    );
  }
}
