<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600");

$servername = "localhost";
$username = "id21338512_root";
$password = "aS?\&65mi@_?pU~^";
$dbname = "id21338512_car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    $sql = "SELECT username, email FROM task_user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userId);
    $stmt->execute();
    $stmt->bind_result($username, $email);
    $stmt->fetch();
    $stmt->close();

    if ($username !== null) {
        
        $response = array('username' => $username,'email'=> $email);
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'User not found'));
    }
}

$conn->close();
?>
