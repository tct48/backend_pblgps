<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$name;
$status;
$classroom;
$situation;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'PUT') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['_id'])) {
        $sql = "UPDATE exercise SET name='$name', status='$status', classroom='$classroom', situation='$situation' WHERE _id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'แก้ไขข้อมูลสำเร็จ']);
        } else {
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    } else {
        $response = (object) ['message' => 'Missing body'];
    }
} else {
    $response = (object) ['message' => 'Method is not _GET'];
}
echo (json_encode($response));

function setBody()
{
    global $object;
    global $name;
    global $id;
    global $status;
    global $classroom;
    global $situation;

    $id = $object['_id'];
    $name = $object['name'];
    $status = $object['status'];
    $classroom = $object['classroom'];
    $situation = $object['situation'];
}
