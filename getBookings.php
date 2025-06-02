<?php
require_once 'auth.php';

if (!$userid = checkAuth()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$userid = (int)$userid;
$query = "SELECT * FROM bookings WHERE bookings.user_id = $userid";

$res = mysqli_query($conn, $query);
if (!$res) {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    exit;
}

$bookingsArray = array();

while($entry = mysqli_fetch_assoc($res)) {
    $bookingsArray[] = array(
        'flight_id' => $entry['flight_id'],
        'price' => $entry['price']
    );
}

echo json_encode($bookingsArray);
mysqli_close($conn);
?>