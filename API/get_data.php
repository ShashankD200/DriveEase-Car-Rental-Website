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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$userid = $_GET['userId'] ?? '';

$userid = mysqli_real_escape_string($conn, $userid);

$sqlRetrieveTasks = "SELECT id, title, description, created_at FROM tasks WHERE user_id = ? AND DATE(created_at) = CURDATE()";

$stmt = $conn->prepare($sqlRetrieveTasks);
$stmt->bind_param("s", $userid);
$stmt->execute();

$result = $stmt->get_result();

$response = array();

if ($result === false) {
    $response['error'] = "Error executing the SQL query: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $task = array(
                'id' => $row["id"],
                'title' => $row["title"],
                'description' => $row["description"],
                'created_at' => $row["created_at"] ?? null,
            );

            array_push($response, $task);
        }
    } else {
        $response['message'] = "0 results";
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();

?>
