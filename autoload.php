<?php
$use = 'App';
$use_dir = 'app.config.json';
require './config/app.config.php';
require './config/functions.php';
require './config/db.php';
include('./utilities/header.php');

if(isset($_REQUEST['t'])){
    $req = htmlspecialchars($_REQUEST['t']);
    $errors = [];
    //fetching data from db
    $stmt = $conn->prepare("SELECT * FROM data WHERE table_key=? LIMIT 1");
    $stmt->bind_param('s',$req);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataCount = $result->num_rows;

    if(!$dataCount > 0){
        $errors[0] = "<b>Error 404:</b> <br>Requested TimeTable cannot be located on the server. It may be removed from the server or your query is invalid!";
    } else {
        $DATA = mysqli_fetch_assoc($result);
    }
    
    if(count($errors) === 0){
        include './utilities/view-timetable.php';
    } else {
        include './utilities/error-template.php';
    }
} else {
    include './utilities/homepage.php';
}

include('./utilities/footer.php');
