<?php
session_start();

if (empty($_SESSION['id'])) {
    header("Location: login.php");
}

include_once "db_connect.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign to Standard Section</title>
    <style>
        table {
            border: 1px solid black;
            border-spacing: 0;
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
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            border: none;
            border-radius: 5px;
            font-size: 17px;
        }

        button a {
            text-decoration: none;
            color: white;

        }

        button:hover {
            background: black;
            color: white;
        }
    </style>
</head>


<body>
    <h2>Assign Subject to Standard Section</h2>
    <form action="" method="post">
        <label for="select_subject">Select Subject:</label>
        <select name="subjectname">
            <?php
            $query = "SELECT * FROM subjects";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['subjects'];
                $id = $row['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <label for="select_Chapter">Select Standard:</label>
        <select name="stdname">
            <?php
            $query = "SELECT * FROM standards";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['std_name'];
                $id = $row['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <input type="submit" name="submitsub" value="Add Subject">
    </form>

    <?php
    $query = "SELECT sub_std.*, subjects.subjects As sub_name, standards.std_name AS std_name
    FROM `sub_std` 
    JOIN subjects ON subjects.id = sub_std.sub_id
    JOIN standards ON standards.id = sub_std.std_id ";
    
    $result = mysqli_query($conn, $query);

    ?>

    <h3>Standard Subject Table</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <th>ID</th>
            <th>Standard name</th>
            <th>Subject name</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['std_name']; ?></td>
                    <td><?php echo $row['sub_name']; ?></td>

                </tr><?php
            }
        } else {
                ?>
                <tr>
                    <td colspan="3"> No record Found</td>
                </tr>
            <?php
        }
            ?>
    </table>

    <h2>Assign Students to Standard Section</h2>
    <?php
            // $query="Select Id, Full_Name from user where Id = (Select user_id from user_type where access_id = 3)";
            // $result = mysqli_query($conn, $query);
            
    
   
    ?>
    <form action="" method="post">
        <label for="select_student">Select Student:</label>
        <select name="studentname">
            <?php
            $query="Select user.Id, user.Full_Name from user INNER JOIN user_type ON user.id = user_type.user_id where user_type.access_id = 3";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['Full_Name'];
                $id = $row['Id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <label for="select_Chapter">Select Standard:</label>
        <select name="stdname">
            <?php
            $query = "SELECT * FROM standards";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['std_name'];
                $id = $row['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <input type="submit" name="submituser" value="Add Subject">
    </form>

    <?php
    $selct_stud_query = "SELECT student_std.*, user.Full_Name As student_name, standards.std_name AS std_name
    FROM `student_std` 
    JOIN user ON user.id = student_std.student_id
    JOIN standards ON standards.id = student_std.std_id ";
    
    $result = mysqli_query($conn, $selct_stud_query);

    ?>
    <h3>Standard Student Table</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <th>ID</th>
            <th>Student name</th>
            <th>Standard name</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['std_name']; ?></td>

                </tr><?php
            }
        } else {
                ?>
                <tr>
                    <td colspan="3"> No record Found</td>
                </tr>
            <?php
        }
            ?>
    </table>
    <br>
        <a href="homepage.php">Back to Homepage</a>

        <?php
        if (isset($_POST['submituser'])) {

            $student_name = $_POST['studentname'];
            $standard_name = $_POST['stdname'];

            $assign_chap_query = "insert into student_std (student_id, std_id) values ('$student_name', '$standard_name')";
       
            $result = mysqli_query($conn, $assign_chap_query);
            if ($result) {
                $message = 'Subject is assign to standard.';
                echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="assign_sub.php";</script>';
            } else {
                $message = 'Subject is not assign to standard.';
                echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="assign_sub.php";</script>';
            }
        }
        ?>
</body>

</html>