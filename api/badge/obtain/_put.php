<?php
include("../../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$badge;
$member;
$id;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'PUT') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['badge']) && isset($object['member'])) {
        $sql = "UPDATE obtain SET badge='$badge', member='$member' WHERE _id='$id'";
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
    global $badge;
    global $member;
    global $id;

    $id = $object['id'];
    $badge = $object['badge'];
    $member = $object['member'];
}
