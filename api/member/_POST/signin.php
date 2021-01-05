<?php
include("../../../connect.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

// ข้อมูลที่ส่งมาจาก body raw
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

if ($requestMethod == 'POST') {

    if (isset($object['username']) && isset($object['password'])) {
        $username = $object['username'];
        $password = md5($object['password']);
        $sql = "SELECT * FROM member WHERE username='$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        $count = mysqli_num_rows($result);
        if($count>0){
            while ($row = mysqli_fetch_assoc($result)){
                $arr[] = $row;
            }
            $data = (object) ['total_items'=>$count,'message'=>"Success", 'item'=>$arr[0]];
        }else{
            $data = (object) ['total_items'=>0, 'item'=>null];
        }

        echo (json_encode($data));
    }
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