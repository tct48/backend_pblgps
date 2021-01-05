<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$id;
$sid;
$firstname;
$lastname;
$image;
$exp;
$email;
$guild;
$username;
$password;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'PUT') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['_id'])) {
        $sql = "UPDATE member SET sid='$sid',firstname='$firstname', lastname='$lastname', image='$image', exp=$exp, email='$email',guild=$guild  WHERE _id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'แก้ไขข้อมูลสำเร็จ']);
        } else {
            echo $sql;
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
    global $firstname;
    global $lastname;
    global $image;
    global $exp;
    global $email;
    global $guild;
    global $username;
    global $sid;
    global $password;

    $id = $object['_id'];
    $sid = $object['sid'];
    $firstname = $object['firstname'];
    $lastname = $object['lastname'];
    $image = $object['image'];
    $exp = $object['exp'];
    $email = $object['email'];
    $guild = $object['guild'];
    $username = $object['username'];
    $password = md5($object['password']);
}
