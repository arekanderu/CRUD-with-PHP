<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'database') or die(mysqli_error($mysqli));

$title = '';
$author = '';
$date_published = '';
$status = '';
$update = false;
$id = 0;
$last_modified = date('Y-m-d H:i:s');

/**
 * CREATE
 */
if(isset($_POST['create'])){
  $title = $_POST['title'];
  $author = $_POST['author'];
  $date_published = $_POST['date_published'];
  $status = 'active';

$mysqli->query("INSERT INTO data (title, author, date_published, last_modified, status)
                VALUES('$title', '$author', '$date_published', '$last_modified', '$status')")
                OR die($mysqli->error);

$_SESSION['message'] = "Your record was successfully posted.";
$_SESSION['msg_type'] = "success";

header("location: index.php");
exit();
}

/**
 * DELETE
 */
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM data
                  WHERE id=$id")
                  OR die($mysqli->error);


$_SESSION['message'] = "Record was successfully removed.";
$_SESSION['msg_type'] = "danger";

header("location: index.php");
exit();
}

/**
 * UPDATE
 * GETS THE DATA THAT WILL BE EDITED.
 */
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;

  $result = $mysqli->query("SELECT * FROM data
                            WHERE id=$id")
                            OR die($mysqli->error);

  if(isset($result)) {
    $row = $result->fetch_array();
    $title = $row['title'];
    $author = $row['author'];
    $date_published = $row['date_published'];
  }
}

//ACTUAL UPDATE
if (isset($_POST['update'])){
  $id = $_POST['id'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $date_published = $_POST['date_published'];

  $mysqli->query("UPDATE data
                  SET title='$title',
                      author='$author',
                      date_published='$date_published',
                      last_modified='$last_modified'
                  WHERE id=$id")
                  OR die($mysqli->error);

$_SESSION['message'] = "Record was successfully updated.";
$_SESSION['msg_type'] = "primary";

header("location: index.php");
exit();
}

/**
 * VIEW DETAILS.
 */
if(isset($_GET['id'])){
  $id = $_GET['id'];

  $result = $mysqli->query("SELECT * FROM data
                            WHERE id=$id")
                            OR die($mysqli->error);

  if(isset($result)) {
    $row = $result->fetch_array();
    $title = $row['title'];
    $author = $row['author'];
    $date_published = $row['date_published'];
  }
}

/**
 * FORM VALIDATION.
 */
$title_error =
$author_error =
$date_published_error = '';

if(empty($_POST['title'])){
  $title_error = "* Required field.";
}

if(empty($_POST['author'])){
  $author_error = "* Required field.";
}

if(empty($_POST['date_published'])){
  $date_published_error = "* Required field.";
}

?>
