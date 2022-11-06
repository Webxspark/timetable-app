<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
    session_start();
    $use     = "ajax";
    $use_dir = '../app.config.json';
    include '../config/app.config.php';
    include '../config/functions.php';
    require '../config/db.php';
    $data = [];
    function inserNewTable($conn)
    {
        $App = new webxspark_admin;
        $timetable = $_REQUEST['timetable'];
        $ci = htmlspecialchars($_REQUEST['ci']);
        $year = htmlspecialchars($_REQUEST['year']);
        $sem = htmlspecialchars($_REQUEST['sem']);
        $class = htmlspecialchars($_REQUEST['class']);
        if ($year === '' || $ci === '' || $sem === '' || $class === '') {
            return ['error' => 'Please fill all the required field!'];
        }
        $check = $App->getObjCountFromDb($conn, 'data', 'class', $class);
        if ($check > 0) {
            return ['error' => 'Class TimeTable already exists!'];
        }
        $author = $App->decrypt_str($_COOKIE[TAG]);
        $todo = json_encode([]);
        $timetable = json_encode($timetable);
        $table_key = $App->generate_license('WXP-TIMETABLE');
        $views = 0;
        //inserting data into database
        $sql = "INSERT INTO data(author,year,sem,class,class_incharge,periods,todo,table_key,views) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssss', $author, $year, $sem, $class, $ci, $timetable, $todo, $table_key, $views);
        if ($stmt->execute()) {
            return ['status' => 200, 'message' => 'Timetable added to the list!'];
        } else {
            return ['error' => '<b>Database Error:</b><br>Something went wrong while adding new TimeTable. Please try again later!'];
        }
    }
    function updateTable($conn)
    {
        $App = new webxspark_admin;
        $timetable = json_encode($_REQUEST['timetable']);
        $ci = htmlspecialchars($_REQUEST['ci']);
        $year = htmlspecialchars($_REQUEST['year']);
        $sem = htmlspecialchars($_REQUEST['sem']);
        $class = htmlspecialchars($_REQUEST['class']);
        $key = htmlspecialchars($_REQUEST['key']);
        if ($year === '' || $ci === '' || $sem === '' || $class === '' || $key === '') {
            return ['error' => 'Please fill all the required field!'];
        }
        $check = $App->getObjCountFromDb($conn, 'data', 'table_key', $key);
        if ($check === 0) {
            return ['error' => '<b>Error 404:</b><br> Unable to find the specified TimeTable. Please refresh this page!'];
        }
        $sql = "UPDATE data SET year=?, sem=?, class=?, class_incharge=?,periods=? WHERE table_key='" . $key . "'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $year, $sem, $class, $ci, $timetable);
        if ($stmt->execute()) {
            return ['status' => 200, 'message' => 'Timetable updated successfully!'];
        } else {
            return ['error' => '<b>Database Error:</b><br>Something went wrong while executing your request. Please try again later!'];
        }
    }
    function fetchData($conn)
    {
        $key = htmlspecialchars($_REQUEST['key']);
        $sql = "SELECT * FROM data WHERE table_key=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $key);
        $stmt->execute();
        $res = $stmt->get_result();
        $output = mysqli_fetch_assoc($res);
        mysqli_next_result($conn);
        //filtering output from XSS vulnerabilities
        $tmp = json_decode($output['periods'], true);
        foreach ($tmp as $key => $val) {
            foreach ($val as $k => $v) {
                $tmp[$key][$k] = htmlspecialchars($v);
            }
        }
        $output['periods'] = $tmp;
        return $output;
    }
    function deleteTable($conn)
    {
        $App = new webxspark_admin;
        $key = htmlspecialchars($_REQUEST['key']);
        $stmt = $conn->prepare("DELETE FROM data WHERE table_key=? LIMIT 1");
        $stmt->bind_param('s', $key);
        if ($stmt->execute()) {
            return ['status' => 200, 'message' => 'TimeTable removed from list!'];
        } else {
            return ['error' => '<b>Database Error:</b><br>Something went wrong while executing your request. Please try again later!'];
        }
    }
    if (isset($_REQUEST['action'])) {
        $request = $_REQUEST['action'];
        if ($request === "insert-new") {
            $data = inserNewTable($conn);
        }
        if ($request === "fetch") {
            $data = fetchData($conn);
        }
        if ($request === "update") {
            $data = updateTable($conn);
        }
        if ($request === "delete") {
            $data = deleteTable($conn);
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
