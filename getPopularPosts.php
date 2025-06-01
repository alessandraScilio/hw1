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

$query = "SELECT articles.title,
                 articles.image_url,
                 articles.content, 
                 COUNT(likes.id) AS numLikes 
    FROM articles 
    JOIN likes ON articles.id = likes.article_id
    GROUP BY articles.id
    ORDER BY numLikes DESC
    LIMIT 4;
    ";

$res = mysqli_query($conn, $query);
if (!$res) {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    mysqli_close($conn);
    exit;
}

$postArray = [];

while ($entry = mysqli_fetch_assoc($res)) {
    $postArray[] = [
        'title' => $entry['title'],
        'image_url' => $entry['image_url'],
        'content' => $entry['content']
    ];
}

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($postArray);
exit;
?>
