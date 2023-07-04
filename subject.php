<?php
session_start();


if (empty($_SESSION['id'])) {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2,
        h3 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background: #71b7e6;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            border: 1px solid black;
            border-spacing: 0;
            width: 1100px;
            margin: 0 auto;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        button {
            padding: 10px 10px;
            margin: 5px;
            background: #71b7e6;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            color: white;
            cursor: pointer;
        }

        button a {
            text-decoration: none;
            color: white;
        }

        button:hover {
            background: black;
        }

        .no-record {
            text-align: center;
            margin-top: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>


<body>
    <h2>Subject Section</h2>
    <form action="" method="post">
        <label for="subject">Add new Subject:</label>
        <input type="text" placeholder="Add Subject" name="subject">
        <input type="submit" name="add_subject" value="Add Subject">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_subject'])) {
        $subject = $_POST['subject'];
        $insert_sub_query = "insert into subjects (subjects) value ('$subject')";
        $result = mysqli_query($conn, $insert_sub_query);
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Subject is not added..")
                window.location.href = "subject.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM subjects WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Subject:</label>
            <input type="text" name="update_subject" value="<?php echo $row['subjects'] ?>">
            <input type="submit" name="edit_subject" value="Update">
        </form>
    <?php
        if (isset($_POST['edit_subject'])) {
            $sub = $_POST['update_subject'];
            $edit_query = "update subjects set subjects='$sub' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:subject.php");
            } else {
                $message = 'subject not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query="DELETE FROM subjects WHERE id = $id";
        $result = mysqli_query($conn, $query);
   
        if(!$result){
           $message = 'Record is not deleted. Please Try again.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
   
        } else {
           $message = 'Record is Deleted Successfully.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="subject.php";</script>';
   
        }
    }


    $query = "select * from subjects";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Subjects</h3>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <table>
            <tr>
                <td>ID</td>
                <td>Subject Name</td>
                <td>Action</td>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['subjects']; ?></td>
                    <td>
                        <button><a href='subject.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button><a href='subject.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <div class="no-record">
            No records found.
        </div>
    <?php
    }
    ?>
    <a class="back-link" href="homepage.php">Back to Homepage</a>
</body>

</html>
