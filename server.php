<?php
include 'config/db_conn.php';

// get data from database
if($_GET['action'] === 'fetchData'){
    $sql = "SELECT * FROM `user`";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data
    ]);
}

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


// fetch single data for update
if($_GET['action'] === 'fetchSingleData' ) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
            "statusCode" => 200,
            "data" => $data
        ]);
    } else {
        echo json_encode([
            "statusCode" => 404,
            "message" => "Data not found"
        ]);
    }
}



// function for update data
if($_GET['action'] === 'updateData'){
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST
    ['email']) && !empty($_POST['carer']) && !empty($_POST["gender"])){

        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);   
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $carer = mysqli_real_escape_string($conn, $_POST['carer']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);

        if($_FILES['image']["size"] != 0){
            $original_name = $_FILES['image']['name'];
            $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $new_name);
            // remove old image from uploads folder
            unlink('uploads/' . $_POST['image_old']);
        }else{
            $new_name = mysqli_real_escape_string($conn, $_POST['image_old']);
        }

        $sql = "UPDATE `user` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email'
        ,`image`='$new_name',`carer`='$carer',`gender`='$gender' WHERE `id` = '$id'";
        if(mysqli_query($conn, $sql)){
            echo json_encode([
                "statusCode" => 200,
                "message" => "Data upadate successfully"
            ]);
        } else {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Data not updated"
            ]);
        }
        mysqli_close($conn);
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "All fields are required"
        ]);
    }
}

// delete data from database
if($_GET['action'] === 'deleteData'){
    $id = $_POST['id'];
    $image = $_POST['image'];
    $sql = "DELETE FROM `user` WHERE `id` = '$id'";
    if(mysqli_query($conn, $sql)){
        // remove image from uploads folder
        unlink('uploads/' . $image);
        echo json_encode([
            "statusCode" => 200,
            "message" => "Data deleted successfully"
        ]);
    } else {
        echo json_encode([
            "statusCode" => 500,
            "message" => "Data not deleted"
        ]);
    }
}

?>