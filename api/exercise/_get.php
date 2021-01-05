<?php
include("../../connect.php");

// default value
$sp = 0;
$lp = 10;
$sql = "";
$_id;

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == 'GET') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($_GET['sp'])) {
        $sp = $_GET['sp'];
        $lp = $_GET['lp'];
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo getOne($id);
    }  else {
        echo getAll();
    }
}

function getOne($id)
{
    global $sql;
    $sql = "SELECT * FROM exercise WHERE _id=$id";
    return execute_data($sql, "false");
}

function getAll()
{
    global $sp, $lp, $sql;
    $sql = "SELECT * FROM exercise LIMIT $sp, $lp";
    return execute_data($sql);
}

// จะไดจำนวน Record ในฐานข้อมูลทั้งหมด ตาม SQL 
function show_all()
{
    global $sql, $conn;
    $sql = "SELECT _id FROM exercise";
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

