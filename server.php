<?php
include 'config/db_conn.php';

// insert data to database
if($_GET['action'] === 'insertData'){
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST
    ['email']) && !empty($_POST['carer']) && !empty($_POST["gender"]) && $_FILES['image']
    ["size"] != 0 ) {
       
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);   
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $carer = mysqli_real_escape_string($conn, $_POST['carer']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        
        // rename image file 
        $original_name = $_FILES['image']['name'];
        $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $new_name);

        $sql = "INSERT INTO `user`(`id`, `first_name`, `last_name`, `email`, `image`, `carer`, `gender`)
                VALUES (NULL, '$first_name', '$last_name', '$email', '$new_name', '$carer', '$gender')";

        if(mysqli_query($conn, $sql)){
            echo json_encode([
                "statusCode" => 200,
                "message" => "Data inserted successfully"
            ]);
        } else {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Data not inserted"
            ]);
        }
    }else{
        echo json_encode([
            "statusCode" => 400,
            "message" => "All fields are required"
        ]);
    }
}

?>