<?php

// so now we will create session and redirect user to index page
session_start();


// access database
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$update= false;
$id=0;

// some garbage is shown in value of inputs
$name='';
$location='';


// save button logic
if (isset($_POST['save'])) {
    # code...
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location')") or
    die($mysqli->error);

    // this is a session message
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msd_type'] = "success";

    header("location: index.php");
}


if (isset($_GET['delete'])) {
    # code...
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msd_type'] = "danger";
    
    // redirect to index pg just one line code
    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    // if (count($result)==1) {
        if (1) {
    
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }

}


// update button logic
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET  name='$name', location='$location' WHERE id=$id") or
    die($mysqli->error);

    // this is a session message
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msd_type'] = "warning";

    header("location: index.php");
}

