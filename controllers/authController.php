<?php

$App = new webxspark_admin();
//checking if user is logged in
if (!$App->check_login_status()) {
    if (!isset($_REQUEST['auth'])) {
        header('Location: ?auth=login');
        exit();
    }
} else {
    include './utilities/admin-template.php';
}
if (isset($_REQUEST['auth'])) {
    $authType = htmlspecialchars($_REQUEST['auth']);
    if (!$App->check_login_status()) {
        if ($authType === "login") {
            include './utilities/login-template.php';
        } else {
            header('Location: ?auth=login');
            exit();
        }
    } else {
        header('Location: ./admin');
        exit();
    }
}