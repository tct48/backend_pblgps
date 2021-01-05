<?php
include("../../connect.php");

// default value
$sql = "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$sid;
$firstname;
$lastname;
$image;
$exp;
$email;
$guild;
$username;
$password;
$role;
$response;

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

// กำหนดค่าให้กับตัวแปร
setBody();

if ($requestMethod == 'POST') {
    // ถ้ามีการกำหนด LIMIT
    if (isset($object['username'])) {
        $sql = "INSERT INTO member (sid, firstname, lastname, image, exp, email, guild, username, password, role) VALUES ('$sid', '$firstname','$lastname','$image', $exp,'$email','$guild', '$username','$password',$role)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = ((object) ['message' => 'เพิ่มข้อมูลสำเร็จ']);
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
    global $sid;
    global $firstname;
    global $lastname;
    global $image;
    global $exp;
    global $email;
    global $guild;
    global $username;
    global $password;
    global $role;

    $sid = $object['sid'];
    $firstname = $object['firstname'];
    $lastname = $object['lastname'];
    $image = $object['image'];
    $exp = $object['exp'];
    $email = $object['email'];
    $guild = 0;
    $role = 2; //student
    if (isset($object['role']))
        $role = $object['role'];
    if (isset($object['guild'])) {
        $guild = $object['guild'];
    }
    $username = $object['username'];
    $password = md5($object['password']);
}
