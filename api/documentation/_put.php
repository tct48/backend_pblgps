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


if ($requestMethod == 'PUT') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['_id'])) {
        $_id = $object['_id'];
        $name = $object['name'];
        $file = $object['file'];

        $sql = "UPDATE documentation SET name='$name', file='$file' WHERE _id=$_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'แก้ไขข้อมูลสำเร็จ']);
        }else{
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    }else{
        $response = (object) ['message' => 'Missing body name'];
    }
}else{
    $response = (object) ['message' => 'Method is not _PUT'];
}
echo (json_encode($response));
