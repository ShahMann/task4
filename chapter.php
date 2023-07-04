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
    <title>Chapter Section</title>
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

        form input[type="submit"]:hover {
            background: black;
        }

        table {
            border: 1px solid black;
            border-spacing: 0;
            margin: 0 auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .button {
            padding: 10px 10px;
            margin: 5px;
            background: #71b7e6;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .button a {
            text-decoration: none;
            color: white;
        }

        
        .no-record {
            text-align: center;
            margin: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>


<body>
    <h2>Chapter Section</h2>
    <form action="" method="post">
        <label for="subject">Add new Chapter:</label>
        <input type="text" placeholder="Add Chapter" name="chapter">
        <input type="submit" name="add_chapter" value="Add chapter" class="button">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_chapter'])) {
        $chap = $_POST['chapter'];
        $insert_chap_query = "insert into chapters (sub_id, chapter) value (null, '$chap')";
        $result = mysqli_query($conn, $insert_chap_query);
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Chapter is not added..")
                window.location.href = "chapter.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM chapters WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Chapter:</label>
            <input type="text" name="update_chapter" value="<?php echo $row['chapter'] ?>">
            <input type="submit" name="edit_chapter" value="Update" class="button">
        </form>
    <?php
        if (isset($_POST['edit_chapter'])) {
            $chap = $_POST['update_chapter'];
            $edit_query = "update chapters set chapter='$chap' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:chapter.php");
            } else {
                $message = 'Chapter not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query="DELETE FROM chapters WHERE id = $id";
        $result = mysqli_query($conn, $query);
   
        if(!$result){
           $message = 'Record is not deleted. Please try again.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="chapter.php?edit=<?php echo $row["id"]";</script>';
   
        } else {
           $message = 'Record is deleted successfully.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="chapter.php";</script>';
   
        }
    }


    $query = "select * from chapters";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Chapters</h3>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <table align="center">
            <tr>
                <td>ID</td>
                <td>Chapter Name</td>
                <td>Action</td>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['chapter']; ?></td>
                    <td>
                        <button class="button"><a href='chapter.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button class="button"><a href='chapter.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
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
