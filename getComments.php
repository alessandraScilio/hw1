<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header('Location: login.php');
    exit;
}
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$article_id = mysqli_real_escape_string($conn, $_GET['article_id']);

$query = "SELECT comment_text FROM comments WHERE article_id = $article_id ORDER BY created_at DESC LIMIT 2";
$res = mysqli_query($conn, $query);
$comments = [];
while ($row = mysqli_fetch_assoc($res)) {
    $comments[] = $row;
}
header('Content-Type: application/json');
echo json_encode($comments);
?>
