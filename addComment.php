<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header('Location: login.php');
    exit;
}
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$data = json_decode(file_get_contents("php://input"), true);
$article_id = mysqli_real_escape_string($conn, $data['article_id']);
$content = mysqli_real_escape_string($conn, $data['comment']);

$query = "INSERT INTO comments (user_id, article_id, comment_text) VALUES($userid, $article_id, '$content')";
if (mysqli_query($conn, $query)) {
    echo json_encode(['content' => $content]);
} else {
    http_response_code(500);
}
    mysqli_close($conn);
?>
