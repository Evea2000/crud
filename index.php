<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Form</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap.min.css" rel="stylesheet">


  <!-- Main Stylesheet File -->
  <!-- <link href="css/style.css" rel="stylesheet"> -->
</head>

<body>

  <!-- first step -->
  <?php require_once 'process.php';
  ?>
  <!-- first set end -->

  <!-- this will display session messages -->
  <?php
  if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msd_type'] ?>">

      <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>

  <div class="container">

    <!-- creates webpage table from data of database -->
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT*FROM data") or die($mysqli->error); ?>
    <!-- // pre_r($result); -->

    <!-- // pre_r($result->fetch_assoc()); -->


    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <!-- fetches data from database -->
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>

              <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
    <!-- called a function to print  -->
    <?php
    function pre_r($array)
    {
      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
    ?>

    <div class="row justify-content-center">
      <form action="process.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $id;  ?>">

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="Enter your name">
        </div>

        <div class="form-group">
          <label for="">Location</label>
          <input type="text" name="location" class="form-control" value="<?php echo $location ?>" placeholder="Enter your location">
        </div>


        <div class="form-group">
          <?php
          if ($update == true) :
          ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
          <?php else : ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
          <?php endif; ?>
        </div>

      </form>
    </div>
  </div>

  <script src="lib/jquery.min.js"></script>
  <script src="lib/bootstrap.min.js"></script>

</body>

</html>