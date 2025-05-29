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
$query = "SELECT articles.id, articles.title, articles.image_url 
          FROM articles
          JOIN likes ON articles.id = likes.article_id
          WHERE likes.user_id = $userid
          ORDER BY articles.created_at DESC";

$res = mysqli_query($conn, $query);
if (!$res) {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    exit;
}

$postArray = array();

while($entry = mysqli_fetch_assoc($res)) {
    $postArray[] = array(
        'id' => $entry['id'],
        'title' => $entry['title'],
        'image_url' => $entry['image_url']
    );
}

echo json_encode($postArray);
exit;
?>