<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
    session_start();
    $use     = "ajax";
    $use_dir = '../app.config.json';
    include '../config/app.config.php';
    include '../config/functions.php';
    require '../config/db.php';
    $data = [];

    function validateLoginRequest($conn)
    {
        $App = new webxspark_admin;
        $email = htmlspecialchars($_REQUEST['credentials']['e']);
        $pass = htmlspecialchars($_REQUEST['credentials']['p']);
        $redir = './admin';
        if (isset($_REQUEST['redir'])) {
            if (strlen($_REQUEST['redir']) > 0) {
                $redir = htmlspecialchars($_REQUEST['redir']);
            }
        }

        //check if user exists in db
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        $usrCount = $res->num_rows;
        if ($usrCount > 0) {
            $usrInfo = mysqli_fetch_assoc($res);
            //verifying password
            if (password_verify($pass, $usrInfo['pass'])) {
                $App->set_cookie(TAG, $App->encrypt_str($usrInfo['tag']));
                $App->set_cookie(USERNAME, $App->encrypt_str($usrInfo['username']));
                $App->set_cookie(EMAIL, $App->encrypt_str($usrInfo['email']));
                $App->update_single_val_db($conn, 'users', 'ip', 'tag', $usrInfo['tag'], $App::fetch_ip()); //updating user's ip address
                return ['success' => 'You\'re logged in!', 'redirect' => $redir];
            } else {
                return ['error' => 'Credentials not valid! Please enter correct password.'];
            }
        } else {
            return ['error' => "Email address doesn't exists. Please try again with a valid ones!"];
        }
    }
    function validateLogoutRequest($conn)
    {
        $App = new webxspark_admin;
        if ($App->check_login_status()) {
            $App->unset_cookie(TAG, null);
            $App->unset_cookie(USERNAME, null);
            $App->unset_cookie(EMAIL, null);
            session_destroy();
            return ['status' => 200, 'redirect' => htmlspecialchars($_REQUEST['curl'])];
        } else {
            return ["error" => "You're not logged in!"];
        }
    }
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] === "process-login") {
            $data = validateLoginRequest($conn);
        }
        if ($_REQUEST['action'] === "process-logout") {
            $data = validateLogoutRequest($conn);
        }
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
} else {
    $data_resObj = array(
        'code'   => 403,
        'errors' => array(
            [
                'message' => 'Requests from referer <empty> are blocked.',
                'domain'  => 'global',
                'reason'  => 'forbidden',
                'status'  => 'PERMISSION_DENIED',
            ],
        ),
    );
    $data['error'] = $data_resObj;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
