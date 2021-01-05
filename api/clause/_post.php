<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$question;
$exercise;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'POST') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['question']) && isset($object['exercise'])) {
        $sql = "INSERT INTO clause (question, exercise) VALUES ('$question', '$exercise')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'เพิ่มข้อมูลสำเร็จ']);
        } else {
            $response = ((object) ['message' => 'SQL เกิดข้อผิดพลาด']);
        }
    } else {
        $response = (object) ['message' => 'Missing body question'];
    }
} else {
    $response = (object) ['message' => 'Method is not _GET'];
}
echo (json_encode($response));

function setBody()
{
    global $object;
    global $question;
    global $exercise;

    $question = $object['question'];
    $exercise = $object['exercise'];
}
