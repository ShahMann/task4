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
    <title>Chapter Section</title>
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

        .button {
            padding: 10px 10px;
            margin: 5px;
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            border: none;
            border-radius: 5px;
            font-size: 17px;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .button:hover {
            background: black;
            color: white;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: inline-block;
            margin-right: 10px;
        }

        .form-group select {
            padding: 5px;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            padding: 5px 10px;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            text-decoration: none;
        }

    </style>
</head>


<body>
    <h2>Assign Chapter Section</h2>
    <form action="" method="post">
        <div class="form-group">
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
        </div>
        <div class="form-group">
            <label for="select_Chapter">Select Chapter:</label>
            <select name="chaptername">
                <?php
                $query = "SELECT * FROM chapters";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['chapter'];
                    echo "<option value='$name'>$name</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submitchap" value="Add Chapter" class="button">
        </div>
    </form>

    <p><a href="homepage.php" class="back-link">Back to Homepage</a></p>

    <?php
    if (isset($_POST['submitchap'])) {
        $chapter_name = $_POST['chaptername'];
        $subject_name = $_POST['subjectname'];

        $assign_chap_query = "UPDATE chapters SET sub_id = '$subject_name' WHERE chapter = '$chapter_name'";
        $result = mysqli_query($conn, $assign_chap_query);
    }
    ?>
</body>

</html>
