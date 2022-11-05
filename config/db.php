<?php
if(!defined('config_loaded')){
    $critical_error['error'] = "Failed to connect to database!";
    $critical_error['error_reason'] = "Unable to establish a secure connection with database!! Please contact our developer team to report this issue!";
    die('Database Error:'.$critical_error[0].'<br>'.$critical_error[1]);
} elseif(defined('config_loaded')){
    $App = new webxspark_admin;
    if(defined('enc_database')){
        $db_host = $App->decrypt_str(DB_HOST);
        $db_name = $App->decrypt_str(DB_NAME);
        $db_user = $App->decrypt_str(DB_USER);
        $db_pass = $App->decrypt_str(DB_PASS);
    } elseif(!defined('enc_database')){
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
    }
    $conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if(mysqli_connect_errno()){
        $critical_error['error'] = "Failed to connect to database!";
        $critical_error['error_reason'] = mysqli_connect_error();
        die('Database Error:'.$critical_error[0].'<br>'.$critical_error[1]);
    }
}
