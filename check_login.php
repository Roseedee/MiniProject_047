<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
        include("connection.php");

        //รับค่า user & password

        $Username = $_POST['username'];
        $Password = $_POST['password'];

        //query

        $sql="SELECT * FROM account Where a_username='".$Username."' and a_password='".$Password."' ";
        $result = mysqli_query($con,$sql);
        if($result->num_rows == 1){
            $row = mysqli_fetch_array($result);
            $_SESSION["a_id"] = $row["a_id"];
            $_SESSION["a_username"] = $row["a_username"];
            $_SESSION["a_level"] = $row["a_level"];
            $_SESSION["login-state"] = "Complate";

            if($_SESSION["a_level"]=="A"){ //ถ้าเป็ น admin ให้กระโดดไปหน้า
                header("Location: index.php");
            }else if ($_SESSION["a_level"]=="M"){ //ถ้าเป็ น member ให้กระโดดไปหน้า
                header("Location: user_page.php");
            }
            
        }else{
            echo "<script>";
            echo "alert(\" user หรือ password ไม่ถูกตอ้ง\");";
            echo "window.history.back()";
            echo "</script>";
        }
    }else {
        header('location: form_login.php');
    }
?>