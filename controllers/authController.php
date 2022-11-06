<?php

$App = new webxspark_admin();
//checking if user is logged in
if (!$App->check_login_status()) {
    if (!isset($_REQUEST['auth'])) {
        header('Location: ?auth=login');
        exit();
    }
} else {
    if (empty($_REQUEST)) {
        include './utilities/admin-dashboard.php';
    } else {
        $req = htmlspecialchars($_REQUEST['v']);
        if ($req === 'new') {
            $FUNCTION = "new";
            include './utilities/new-data.php';
        } elseif ($req === "edit") {
            if (isset($_REQUEST['key'])) {
                $errors = [];
                $req = htmlspecialchars($_REQUEST['key']);
                $stmt = $conn->prepare("SELECT * FROM data WHERE table_key=? LIMIT 1");
                $stmt->bind_param('s', $req);
                $stmt->execute();
                $result = $stmt->get_result();
                $dataCount = $result->num_rows;
                $stmt->close();
                if (!$dataCount > 0) {
                    $errors[0] = "<b>Error 404:</b> <br>Requested TimeTable cannot be located on the server. It may be removed from the server or your query is invalid!";
                } else {
                    $DATA = mysqli_fetch_assoc($result);
                }
                if (count($errors) === 0) {
                    $FUNCTION = "edit";
                    include './utilities/new-data.php';
                } else {
                    include './utilities/error-template.php';
                }
            } else {
                header('Location: ./');
                exit();
            }
        }
    }
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
