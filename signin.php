<?php
include_once "db_connect.php";
session_start();

if (isset($_POST['login'])) {
    $pswd = md5($_POST['Password']);


    $query = "SELECT user.*, accesstype.access_type AS access
    FROM `user` 
    JOIN user_type ON user.Id = user_type.user_id 
    JOIN accesstype ON user_type.access_id = accesstype.id 
    WHERE Email_ID='$_POST[Email_ID]'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if (empty($row)) {
        $_SESSION['error'] = '<font color="red">Form is not submitted, Please try again.</font>';
        header("location: ./login.php");
    } elseif(isset($result)) {
            if (($row['Email_ID'] == $_POST['Email_ID']) && $row['Password'] == $pswd) {
                
                $_SESSION['name'] = $row['Full_Name'];
                $_SESSION['email'] = $row['Email_ID'];
                $_SESSION['id'] = $row['Id'];
                $_SESSION['access']=$row['access'];
?>
                <script type="text/javascript">
                    alert("Login is done Successfully.");
                    window.location.href = "login.php";
                </script>
<?php
                header("Location:homepage.php");
            } else {
                $_SESSION['error'] = '<font color="red">Email or password doesnt exists.</font>';
                header("location: ./login.php");
            }
    } else {
        $_SESSION['error'] = '<font color="red">Account doesnt exists.</font>';
                header("location: ./login.php");
    }
} else {
    $_SESSION['error'] = '<font color="red">Try Again !!</font>';
    header("location: ./login.php");
}
?>