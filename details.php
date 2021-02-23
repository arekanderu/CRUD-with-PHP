<?php require_once 'process.php'?>
<?php
  $mysqli = new mysqli('localhost', 'root', '', 'database') or die(mysqli_error($mysqli));
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>WorkerBee.TV</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- BOOK INFORMATION -->
  <div class="card" style="width: 100%">
    <div class="card-header">
      <h2>Book Information</h2>
    </div>
    <ul class="card-body">
      <li>
        <b>Title: </b>
        <?php echo $title; ?>
      </li>
      <li>
        <b>Author: </b>
        <?php echo $author; ?>
      </li>
      <li>
        <b>Date Published: </b>
        <?php echo $date_published; ?>
      </li>
    </ul>

    <!-- ACTION BUTTON (EDIT, DELETE) -->
    <div class="card-footer">
      <a href="index.php?edit=<?php echo $row['id']; ?>"
        class="btn btn-primary">Edit Post
      </a>
      <a href="index.php?delete=<?php echo $row['id']; ?>"
        class="btn btn-danger damger">Delete
      </a>
    </div>
  </div>
</body>
</html>