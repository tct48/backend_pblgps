<?php
include("../../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$name;
$image;
$id;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'DELETE') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['id'])) {
        $sql = "DELETE FROM obtain WHERE _id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    } else {
        $response = (object) ['message' => 'Missing body name'];
    }
} else {
    $response = (object) ['message' => 'Method is not _GET'];
}
echo (json_encode($response));

function setBody()
{
    global $object;

    global $id;

    $id = $object['id'];
}
