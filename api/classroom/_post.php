<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// Example do not delete
// $object['name'];
// $response = ((object) ['message' => 'เพิ่มข้อมูลสำเร็จ']);
// echo (json_encode($response));


if ($requestMethod == 'POST') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['name'])) {
        $name = $object['name'];
        $sql = "INSERT INTO classroom (name) VALUES ('$name')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'เพิ่มข้อมูลสำเร็จ']);
        }else{
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    }else{
        $response = (object) ['message' => 'Missing body name'];
    }
}else{
    $response = (object) ['message' => 'Method is not _GET'];
}
echo (json_encode($response));
