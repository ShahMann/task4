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
    <title>User Data</title>
    <style>
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

        button {
            padding: 10px 10px;
            margin: 5px;
            background:#71b7e6;
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

        h1 {
            text-align: center;
        }

        img {
            width: 200px;
        }

        .no-image {
            text-align: center;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
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
    <?php
    include "db_connect.php";
    $query = "select * from user";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>
        <h1>User Data</h1>
        <table style="width: 1100px;">
            <tr>
                <?php
                $row = mysqli_fetch_assoc($result);
                foreach ($row as $column => $value) {
                    if ($column == 'Password') {
                        continue;
                    } else {
                        echo "<th> ".strtoupper($column). "</th>";
                    }
                }
                ?>
                <th>Action</th>
            </tr>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Full_Name']; ?></td>
                <td><?php echo $row['Email_ID']; ?></td>
                <td><?php echo $row['Contact_No']; ?></td>
                <td><?php echo $row['Dob']; ?></td>
                <td> <?php
                    if ($row['image']) {
                        $image_path = '../task_2/Profile_image/' . $row['image'];
                        echo '<img src="' . $image_path . '" alt="Profile Image">';
                    } else {
                        echo '<div class="no-image">No image available</div>';
                    }
                ?></td>
                <td>
                    <button><a href='action/edit.php?edit=<?php echo $row["Id"] ?>'>Edit</a></button>
                    <button><a href='action/delete.php?delete=<?php echo $row["Id"] ?>'>Delete</a></button>
                    <button><a href='action/view.php?view=<?php echo $row["Id"] ?>'>View</a></button>
                </td>
            </tr>
            <?php
            while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Full_Name']; ?></td>
                <td><?php echo $row['Email_ID']; ?></td>
                <td><?php echo $row['Contact_No']; ?></td>
                <td><?php echo $row['Dob']; ?></td>
                <td><?php
                    if ($row['image']) {
                        $image_path = '../task_2/Profile_image/' . $row['image'];
                        echo '<img src="' . $image_path . '" alt="Profile Image">';
                    } else {
                        echo '<div class="no-image">No image available</div>';
                    }
                ?></td>
                <td>
                    <button><a href='action/edit.php?edit=<?php echo $row["Id"] ?>'>Edit</a></button>
                    <button><a href='action/delete.php?delete=<?php echo $row["Id"] ?>'>Delete</a></button>
                    <button><a href='action/view.php?view=<?php echo $row["Id"] ?>'>View</a></button>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="back-link">
            <p><a href="homepage.php">Back to home</a></p>
        </div>
    <?php
    } else {
        $message = 'Row Data Not Found.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="index.php";</script>';
    }
    ?>
</body>

</html>
