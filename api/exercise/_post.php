<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$name;
$status;
$classroom;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'POST') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['classroom'])) {
        $sql = "INSERT INTO exercise (name, status, classroom, situation) VALUES ('$name', $status,$classroom, $situation)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'เพิ่มข้อมูลสำเร็จ']);
        } else {
            echo $sql;
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    } else {
        $response = (object) ['message' => 'Missing body'];
    }
} else {
    $response = (object) ['message' => 'Method is not POST'];
}
echo (json_encode($response));

function setBody()
{
    global $object;
    global $name;
    global $status;
    global $situation;
    global $classroom;

    $name = $object['name'];
    $status = $object['status'];
    $situation = $object['situation'];
    $classroom = $object['classroom'];
}
