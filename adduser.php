<?php
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
?>

<?php
include "db_connect.php";

if(isset($_POST['add_user'])){
    $pswd=md5($_POST['password']);
    $accesstype=$_POST['accesstype'];
    
    $query="select Email_ID from user";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $email_id[]=$row['Email_ID'];
    }
   
    if(in_array($_POST['email_ID'],$email_id)){
        $_SESSION['error']='<font color="red">Email Id Already exists.</font>';
        header("location: /adduser.php");
    } 
    else {
        $insert_query = "insert into user values(null,'$_POST[full_name]','$_POST[email_ID]',$_POST[contact_no],'$_POST[dob]','$pswd','')";
        $insert_result = mysqli_query($conn,$insert_query);
        $id=mysqli_insert_id($conn);
        $access_query = "insert into user_type(user_id,access_id) values ('$id','$accesstype')";
        $access_result =mysqli_query($conn,$access_query);
        
        if(!$access_result){
            $_SESSION['error']='<font color="red">Form is not submitted, Please try again.</font>';
            header("location: homepage.php");
        } else {
    ?> 
        <script type="text/javascript">
            alert("User Add Successfully..")
            window.location.href = "homepage.php";
        </script>
    <?php
        }
    }
    header("location: ./adduser.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 20px;
        }

        #errorMsg {
            color: red;
        }

        .user-details {
            margin-bottom: 20px;
        }

        .user-details .input-box {
            margin-bottom: 10px;
        }

        .user-details .details {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .user-details input[type="text"],
        .user-details input[type="email"],
        .user-details input[type="password"],
        .user-details input[type="date"],
        .user-details select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .button {
            text-align: center;
            margin-top: 20px;
        }

        .button input[type="submit"] {
            padding: 10px 20px;
            background-color: #71b7e6;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
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
    <div class="container">
        <div class="title">Add User</div>
        <div class="content">
            <center><strong id="errorMsg">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </strong></center>
            <form action="adduser.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="full_name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email ID</span>
                        <input type="email" name="email_ID" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="contact_no" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Date of Birth</span>
                        <input type="date" name="dob" placeholder="yyyy-mm-dd" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">User Type</span>
                        <select name="accesstype" id="" required>
                            <option value="">Select User Type</option>
                            <?php
                            $select_accesstype_sql = "SELECT * FROM accesstype";
                            $select_accesstype_result = mysqli_query($conn, $select_accesstype_sql);

                            while ($fetch_value = mysqli_fetch_assoc($select_accesstype_result)) {
                                echo "<option value='" . $fetch_value['id'] . "'>" . $fetch_value['access_type'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="add_user" value="Add User">
                </div>
            </form>
            <p><a href="login.php">Back To Homagepage</a></p>
        </div>
    </div>
</body>

</html>
