<?php

require_once 'auth.php';

if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = (int)$userid;

$query = "SELECT A.title FROM articles A
          JOIN likes L ON A.id = L.article_id
          WHERE L.user_id = $userid;";

$res = mysqli_query($conn, $query);

$posts = [];

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $posts[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($posts);
?>
