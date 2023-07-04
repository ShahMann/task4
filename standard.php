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
    <title>Standard Section</title>
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
            width: 100%;
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
    <h2>Standard Section</h2>
    <form action="" method="post">
        <label for="standard">Add new Standard:</label>
        <input type="text" placeholder="Add Standard" name="standard">
        <input type="submit" name="add_standard" value="Add Standard">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_standard'])) {
        $std = $_POST['standard'];
        $insert_std_query = "insert into standards (std_name) value ('$std')";
        $result = mysqli_query($conn, $insert_std_query);
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Standard is not added..")
                window.location.href = "standard.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM standards WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Standard:</label>
            <input type="text" name="update_standard" value="<?php echo $row['std_name'] ?>">
            <input type="submit" name="edit_standard" value="Update">
        </form>
    <?php
        if (isset($_POST['edit_standard'])) {
            $std = $_POST['update_standard'];
            $edit_query = "update standards set std_name='$std' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:standard.php");
            } else {
                $message = 'Standard not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="standard.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM standards WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            $message = 'Record is not deleted. Please try again.';
            echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="standard.php?edit=<?php echo $row["id"]";</script>';

        } else {
            $message = 'Record is deleted successfully.';
            echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="standard.php";</script>';

        }
    }


    $query = "select * from standards";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Standards</h3>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <table align="center">
            <tr>
                <td>ID</td>
                <td>Standard Name</td>
                <td>Action</td>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['std_name']; ?></td>
                    <td>
                        <button><a href='standard.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button><a href='standard.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
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
