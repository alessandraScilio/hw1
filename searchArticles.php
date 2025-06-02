<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $userid);

$conditions = [];
if (!empty($_POST['continent'])) {
    $continent = mysqli_real_escape_string($conn, $_POST['continent']);
    $conditions[] = "continent LIKE '%$continent%'";
}
if (!empty($_POST['country'])) {
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $conditions[] = "country LIKE '%$country%'";
}
if (!empty($_POST['city'])) {
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $conditions[] = "city LIKE '%$city%'";
}

$whereClause = '';
if (!empty($conditions)) {
    $whereClause = 'WHERE ';
    $first = true;
    foreach ($conditions as $condition) {
        if (!$first) {
            $whereClause .= ' AND ';
        }
        $whereClause .= $condition;
        $first = false;
    }
}

$query = "SELECT 
            a.*, 
            COUNT(l.id) AS like_count,
            (SELECT COUNT(*) FROM likes WHERE user_id = $userid AND article_id = a.id) AS liked,
            (SELECT COUNT(*) FROM comments WHERE article_id = a.id) AS comment_count
          FROM articles a
          LEFT JOIN likes l ON a.id = l.article_id
          $whereClause
          GROUP BY a.id
          ORDER BY a.created_at DESC";;

$res = mysqli_query($conn, $query);

$articles = [];
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $articles[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($articles);
mysqli_close($conn);

?>