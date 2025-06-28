<?php
require_once "../BdConnect.php";
include "./blade/menuAdmin.php";
include './check_admin.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $pdo->prepare("UPDATE reviews SET status = 'published' WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: tableReviews.php");
exit;
?>
