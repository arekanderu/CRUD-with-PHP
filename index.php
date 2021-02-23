<?php require_once 'process.php'?>
<?php
  $mysqli = new mysqli('localhost', 'root', '', 'database') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM data ORDER BY last_modified DESC") or die($mysqli->error);
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

  <!-- ALERTS -->
  <?php if (isset($_SESSION['message'])): ?>
    <div id="alert-message" class="alert alert-<?=$_SESSION['msg_type'] ?>">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>

  <div class="container">
  <h2>Book Information</h2>
  <br />
    <!-- CREATE FORM -->
    <form id="myForm" action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>" />
        <p class="error" id="title_error"><?php echo $title_error ?></p>
      </div>

      <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" id="author" class="form-control" value="<?php echo $author; ?>" />
        <p class="error" id="author_error"><?php echo $author_error ?></p>
      </div>

      <div class="form-group">
        <label>Date Published</label>
        <input type="date" name="date_published" id="date_published" class="form-control" value="<?php echo $date_published; ?>"/>
        <p class="error" id="date_published_error"><?php echo $date_published_error ?></p>
      </div>

      <!--ACTION BUTTONS (CREATE / UPDATE)-->
      <?php if($update == true): ?>
        <button type="submit" name="update" class="btn btn-secondary">
          Update
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path></svg>
        </button>
      <?php else: ?>
        <button type="submit" name="create" class="btn btn-secondary">
          Submit
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.592 2.712L2.38 7.25h4.87a.75.75 0 110 1.5H2.38l-.788 4.538L13.929 8 1.592 2.712zM.989 8L.064 2.68a1.341 1.341 0 011.85-1.462l13.402 5.744a1.13 1.13 0 010 2.076L1.913 14.782a1.341 1.341 0 01-1.85-1.463L.99 8z"></path></svg>
        </button>
      <?php endif ?>
    </form>

  <!-- LIST ALL -->
  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Date Published</th>
          <th scope="col">Author Name</th>
          <th scope="col">Video Title</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </thead>

      <?php while($row = $result-> fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['date_published']; ?></td>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['author']; ?></td>
          <!-- ACTION BUTTONS (DELETE, EDIT, VIEW) -->
          <td>
            <a href="index.php?delete=<?php echo $row['id']; ?>"
              class="btn btn-danger">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z"></path></svg>
              Delete
            </a>
          </td>

          <td>
            <a href="index.php?edit=<?php echo $row['id']; ?>"
              class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path></svg>
              Edit Post
            </a>
          </td>

          <td>
          <a href="details.php?id=<?php echo $row['id']; ?>"
              class="btn btn-info">
              View Details
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
  </div>

<script src="javascript.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
