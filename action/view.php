<?php
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
include_once "../db_connect.php";


$row = [];

if (isset($_REQUEST['view'])) {
    $id = $_REQUEST['view'];

    $query = "SELECT * FROM user WHERE Id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

    } else {
        $message = 'Data Not Found.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="../viewuser.php";</script>';
    }

    echo '<h2 style="font-size: 40px;"><center>Data Of User</center></h2>';

    echo '<div style="display: flex; justify-content: center;">';
    echo '<div style="margin-right: 50px;">';
    foreach ($row as $column => $value) {
        if ($column === 'image') {
            $image_path = '../Profile_image/' . $value;
            echo ' <img src="' . $image_path . '" height="200" alt="Profile Image"><br>';
        }
    }
    echo '</div>';
    echo '<div>';
    echo '<form method="post">';
    foreach ($row as $column => $value) {
        if ($column !== 'image') {
            echo strtoupper($column) . ' : ';
            echo '<input style="margin: 10px;" type="text" value="' . strtoupper($value) . '" disabled> <br>';
        }
    }
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '<a href="../viewuser.php">Back to home</a>';
}

if (isset($_REQUEST['edit'])) {
    $id = $_REQUEST['edit'];

    $query = "SELECT * FROM user WHERE Id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

    } else {
        $message = 'Data Not Found.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="index.php";</script>';
    }

    if (isset($_POST['Update_Data'])) {
        $Full_Name = $_POST['Full_name'];
        $Email_Id = $_POST['Email_Id'];
        $Contact_No = $_POST['Contact_No'];
        $Dob = $_POST['Dob'];

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: #71b7e6;
            color: white;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"],
        form a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #71b7e6;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        form a {
            background-color: #9b59b6;
        }
        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            text-decoration: none;
        }
        img {
            border-radius: 50%;
        }
    </style>
</head>

<body>
  
   
</body>

</html>
