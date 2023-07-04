<?php
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style> 

    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
    }

    .sidebar {
        width: 250px;
        background-color: #333;
        color: #fff;
        padding: 20px 10px;
    }

    .sidebar a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #fff;
        background-color: #71b7e6;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-top: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .sidebar-header {
        text-align: center;
    }

    .sidebar-footer {
        margin-top: auto;
        margin-bottom: 20px;
        text-align: center;
    }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h1><?php echo "Welcome ". '<br>' .$_SESSION['name'];?></h1>
            <h2><?php echo strtoupper($_SESSION['access']);?></h2>
        </div>
        <a href="viewuser.php">View User</a>
        <a href="adduser.php">Add User</a>
        
        <?php
        if($_SESSION['access']=='Admin' || $_SESSION['access']=='Teacher' ){
            ?>
            <a href="subject.php">Subject Section</a>
            <a href="chapter.php">Chapter Section</a>
            <a href="standard.php">Standard Section</a>
            <a href="assign.php">Assign Subject and Student</a>
            <?php
        } elseif ($_SESSION['access']=='Student' ){
            echo "<p>You are a Student</p>";
        } else {
            echo "Your Details";
        }

        if($_SESSION['access']=='Admin' ){
            ?>
            <a href="assignchap.php">Assign Chapter to Subject</a>
            <?php
        }
        ?>
        
        <div class="sidebar-footer">
            <a href="logout.php">Logout</a>
        </div>
    </div>

   
</body>
</html>