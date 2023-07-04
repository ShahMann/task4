<?php
session_start();

include_once "db_connect.php";

if(isset($_POST['register'])){
    $accesstype=$_POST['accesstype'];
    $email_id = [];
    $query="SELECT Email_ID FROM user";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $email_id[]=$row['Email_ID'];
    }
    
    if(in_array($_POST['email_ID'],$email_id)){
        $_SESSION['error'] = '<font color="red">Email ID already exists.</font>';
        header("location: ./index.php");
    } else {
        if($_POST['password']==$_POST['c_password']){
            $pswd=md5($_POST['password']);
           
            $insert_query = "INSERT INTO user VALUES(null, '$_POST[full_name]', '$_POST[email_ID]', $_POST[contact_no], '$_POST[dob]', '$pswd', '')";
            
            $insert_result = mysqli_query($conn, $insert_query);
 
            $id = mysqli_insert_id($conn);
            $access_query = "INSERT INTO user_type(user_id, access_id) VALUES ('$id', '$accesstype')";
            $access_result = mysqli_query($conn, $access_query);
            
            if(!$access_result){
                $_SESSION['error'] = '<font color="red">Form is not submitted, please try again.</font>';
                header("location: ./index.php");
            } else {
                $_SESSION['email'] = $_POST['email_ID'];
                ?>
                <script type="text/javascript">
                    alert("Registration successful. You may login now.");
                    window.location.href = "login.php";
                </script>
                <?php
            }
    
        } else {
            $_SESSION['error'] = '<font color="red">Confirm password does not match.</font>';
            header("location: ./index.php");
        }
    }
    
} else {
    $_SESSION['error'] = '<font color="red">Try again!</font>';
    header("location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
        }
        .login-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <?php if(isset($_SESSION['error'])) { ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php } ?>
        <form action="" method="post">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email_ID">Email ID:</label>
            <input type="email" name="email_ID" id="email_ID" required>

            <label for="contact_no">Contact No:</label>
            <input type="tel" name="contact_no" id="contact_no" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="c_password">Confirm Password:</label>
            <input type="password" name="c_password" id="c_password" required>

            <label for="accesstype">Access Type:</label>
            <select name="accesstype" id="accesstype">
                <option value="1">Admin</option>
                <option value="2">Teacher</option>
                <option value="3">Student</option>
            </select>

            <input type="submit" name="register" value="Register">
        </form>
        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
