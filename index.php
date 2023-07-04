<?php
session_start();
include_once "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            text-align: center;
        }

        #errorMsg {
            color: red;
            font-weight: bold;
        }

        .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .input-box {
            flex: 0 0 calc(50% - 10px);
            margin-bottom: 20px;
        }

        .input-box .details {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-box input,
        .input-box select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            text-align: center;
            margin-top: 20px;
        }

        .button input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        p a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <center>
                <strong id="errorMsg">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </strong>
            </center>
            <form action="register.php" method="post">
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
                        <span class="details">Confirm Password</span>
                        <input type="password" name="c_password" placeholder="Confirm your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">User Type</span>
                        <select name="accesstype" id="">
                            <option value="">Select User Type</option>
                            <?php
                            $select_accesstype_sql = "SELECT * FROM accesstype";
                            $select_accesstype_result = mysqli_query($conn, $select_accesstype_sql);

                            while ($fetch_value  = mysqli_fetch_assoc($select_accesstype_result)) {
                                echo "<option value='" . $fetch_value['id'] . "'>" . $fetch_value['access_type'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="register" value="Register">
                </div>
            </form>
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>

</html>
