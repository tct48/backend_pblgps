<?php
include("../../../connect.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == 'GET') {

    if (isset($_GET['classroom'])) {
        $classroom = $_GET['classroom'];
        echo getOne($classroom);
    }  else {
        echo getAll();
    }
}

function getOne($classroom)
{
    global $sql;
    $sql = "SELECT * FROM member WHERE classroom=$classroom LIMIT 5";
    return execute_data($sql, "false");
}

function getAll()
{
    global $sp, $lp, $sql;
    $sql = "SELECT * FROM member LIMIT 5";
    return execute_data($sql);
}

// จะไดจำนวน Record ในฐานข้อมูลทั้งหมด ตาม SQL 
function show_all()
{
    global $sql, $conn;
    $sql = "SELECT _id FROM member";
    $query = mysqli_query($conn, $sql);
    return mysqli_num_rows($query);
}

function execute_data($sql, $show_total = 'true')
{
    // เรียกใช้ $conn ภายนอก function
    global $conn;
    $result = mysqli_query($conn, $sql);
    $arr = array();
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    $data[] = (object) ['total_items' => $count, 'items' => $arr];

    if ($show_total == 'false' && $count>0) {
        return json_encode($arr[0]);
    }
    return json_encode(($data));
}

