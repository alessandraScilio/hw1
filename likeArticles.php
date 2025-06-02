<?php 
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$data = json_decode(file_get_contents("php://input"), true);
$article_id = mysqli_real_escape_string($conn, $data['article_id']);

$checkQuery = "SELECT * FROM likes WHERE user_id = $userid AND article_id = $article_id";
$checkRes = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkRes) == 0) {
    $insertQuery = "INSERT INTO likes (user_id, article_id) VALUES ($userid, $article_id)";
    mysqli_query($conn, $insertQuery);
}

$countQuery = "SELECT COUNT(*) AS like_count FROM likes WHERE article_id = $article_id";
$res = mysqli_query($conn, $countQuery);
$row = mysqli_fetch_assoc($res);

header('Content-Type: application/json');
echo json_encode(['like_count' => $row['like_count']]);
mysqli_close($conn);
?>
