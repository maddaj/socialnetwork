<?php
include_once "PDO.php";

function GetOneCommentFromId($id)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM comment WHERE id = :id ");
  $response->execute(
    array(
      "id" => $id
    )
  );
  return $response->fetchAll();
}

function GetAllComments()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM comment ORDER BY created_at ASC");
  return $response->fetchAll();
}

function GetAllCommentsFromUserId($userId)
{
  global $PDO;
  $response = $PDO->prepare("SELECT comment.*, user.nickname FROM comment LEFT JOIN user on (comment.user_id = user.id) WHERE comment.user_id = :id ");
  $response->execute(
    array(
      "id" => $userId
    )
  );
  return $response->fetchAll();
}

function GetAllCommentsFromPostId($postId)
{
  global $PDO;
  $response = $PDO->prepare("SELECT comment.*, user.nickname FROM comment LEFT JOIN user on (comment.user_id = user.id) WHERE comment.post_id = :id ");
  $response->execute(
    array(
      "id" => $postId
    )
  );
  return $response->fetchAll();
}

function CreateNewComment($userId, $postId, $content)
{
  global $PDO;
  if (!empty($comment)) {
    $response = $PDO->prepare("INSERT INTO comment(user_id, post_id, content) values (:userId, :postId, :comment)");
    $response->execute(
      array(
        "userId" => $userId,
        "postId" => $postId,
        "comment" => $content
      )
    );
  }
}
