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
    $price = mysqli_real_escape_string($conn, $data['flight_price']);
    $checkQuery = "SELECT * FROM bookings WHERE flight_id = '$flight_id' AND user_id = $userid";
    $checkRes = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkRes) == 0) {
    $insertQuery = "INSERT INTO bookings (flight_id, user_id, price) VALUES ('$flight_id', $userid, $price)";
    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Insert failed']);
    } 
    } else {
    echo json_encode(['message' => 'Already booked']);
    }
    mysqli_close($conn);
?>
