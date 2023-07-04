<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location: homepage.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .wrapper {
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

        #errorMsg {
            color: red;
            font-weight: bold;
        }

        .field {
            position: relative;
            margin-bottom: 20px;
        }

        .field input {
            width: 100%;
            padding: 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
        }

        .field input:focus {
            border-bottom: 1px solid #007bff;
        }

        .field label {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            transition: 0.3s ease-out;
            color: #888;
        }

        .field input:focus~label,
        .field input:valid~label {
            top: -20px;
            font-size: 12px;
            color: #007bff;
        }

        .field input:-webkit-autofill~label {
            top: -20px;
            font-size: 12px;
            color: #007bff !important;
        }

        .field input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px white inset;
        }

        .field input::-webkit-input-placeholder {
            color: #888;
            font-size: 12px;
        }

        .field input:-ms-input-placeholder {
            color: #888;
            font-size: 12px;
        }

        .field input::-ms-input-placeholder {
            color: #888;
            font-size: 12px;
        }

        .field input::placeholder {
            color: #888;
            font-size: 12px;
        }

        .field input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="title">
            Login Form
        </div>
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
        <form action="signin.php" method="post">
            <div class="field">
                <input type="email" name="Email_ID" value="<?php echo $_SESSION['email']; ?>" required>
                <label>Email Address</label>
            </div>
            <div class="field">
                <input type="password" name="Password" required>
                <label>Password</label>
            </div>
            <div class="field">
                <input type="submit" name="login" value="Login">
            </div>
            <div class="signup-link">
                Don't have an account? <a href="index.php">Register now</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php
