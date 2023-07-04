<?php
session_start();
if (empty($_SESSION['id'])){
   header("Location: login.php");
} 
include_once "../db_connect.php";

if(isset($_REQUEST['delete'])){
     $id=$_REQUEST['delete'];

     $query="DELETE FROM user WHERE id = $id";
     $result = mysqli_query($conn, $query);

     if(!$result){
        $message = 'Record is not deleted. Please Try agin.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="../viewuser.php";</script>';

     } else {
        $message = 'Record is Deleted Successwfully.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="../viewuser.php";</script>';

     }
     
}

?>