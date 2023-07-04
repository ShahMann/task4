<?php
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
include_once "../db_connect.php";


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


        $query = "select * from user where Email_ID = '$Email_Id'";
        $result = mysqli_query($conn, $query);
        $num_exists_row = mysqli_num_rows($result);

        $email = $row['Email_ID'];

        if ($num_exists_row > 0) {

            if ($email !== $Email_Id) {
                $message = 'Email ID already exists.';
                echo '<script type="text/javascript">alert("' . $message . '");</script>';
                echo '<script type="text/javascript"> window.location.href="edit.php?edit="' . $id . ';</script>';
            } else {  


                if (isset($_FILES['file_upload'])) {
                    $username = $id . "_" . $Full_Name;

                    $file_ext = strtolower(end(explode('.', $_FILES['file_upload']['name'])));
                    $typeof_files = ['png', 'jpeg', 'jpg',''];

                    $new_name = $username . "." . $file_ext;



                    $target_path = '../Profile_image/' . basename($new_name);


                    if (!file_exists($target_path)) {
                        if (!(in_array($file_ext, $typeof_files))) {
                            $message = 'Invalid file type. Only JPG, JPEG and PNG types are accepted.';
                            echo '<script type="text/javascript">alert("' . $message . '");</script>';
                        } elseif ($file_size >= 500000) {
                            $message = 'Size must be less than 500KB.';
                            echo '<script type="text/javascript">alert("' . $message . '");</script>';
                        } elseif (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_path)) {
                            $message = 'Image Uploaded Successfully.';
                            echo '<script type="text/javascript">alert("' . $message . '");
                            window.location.href="../viewuser.php";</script>';;

                            $query = "UPDATE user Set Full_Name = '$Full_Name', Email_ID='$Email_Id', Contact_No='$Contact_No', Dob='$Dob', image='$new_name'  Where Id = $id";
                            $result = mysqli_query($conn, $query);
                            if (!$result) {
                                $message = 'Record is Not Updated. Please Try Again';
                                echo '<script type="text/javascript">alert("' . $message . '");
                                window.location.href="../viewuser.php";</script>';
                            } else {
                                $message = 'Record is Updated.';
                                echo '<script type="text/javascript">alert("' . $message . '");</script>';
                                echo '<script type="text/javascript"> window.location.href="edit.php?edit="' . $id . ';</script>';
                            }
                        } else {
                            echo "<script> alert('File Not Uploaded') </script>";
                        }
                    } else {
                        echo "<script> alert('File Already Exist') </script>";
                    }
                }
            }
        } 
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

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
    </style>
</head>

<body>
    <h2>Update Data Of User</h2>

    <form method="post" action="" enctype="multipart/form-data">
        <label for="id">ID:</label>
        <input type="number" id="id" name="Id" value="<?php echo $row['Id'] ?>" disabled><br>
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="Full_name" value="<?php echo $row['Full_Name'] ?>"><br>
        <label for="email">Email ID:</label>
        <input type="email" id="email" name="Email_Id" value="<?php echo $row['Email_ID'] ?>"><br>
        <label for="contact_no">Contact No.:</label>
        <input type="text" id="contact_no" name="Contact_No" value="<?php echo $row['Contact_No'] ?>"><br>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="Dob" value="<?php echo $row['Dob'] ?>"><br>
        <label for="file_upload">Upload Your Image Here:</label>
        <input type="file" id="file_upload" name="file_upload"><br>
        <input type="submit" value="Update Data" name="Update_Data">
        <a href="../viewuser.php">Back to user data</a>
    </form>

</body>

</html>
