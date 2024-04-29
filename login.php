<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        $localhost = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "ajax_crud";
    }

    $conn = new mysqli($localhost, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // validate login authentication
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0){

        header("Location: crud.php");
        exit();

    }else{

      header("Location: fails.html");
        exit();

    }

?>