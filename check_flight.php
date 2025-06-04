<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    
if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
    }

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['flight_id'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
    }

$flight_id = mysqli_real_escape_string($conn, $data['flight_id']);
$checkQuery = "SELECT * FROM bookings WHERE flight_id = '$flight_id' AND user_id = $userid";
$checkRes = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkRes) == 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

mysqli_close($conn);

?>