<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Некорректный ID.");
}

$id = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM ourWorks WHERE id_work = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Запись успешно удалена.'); window.location.href='tableOurWorks.php';</script>";
    } else {
        echo "<script>alert('Не удалось удалить запись.'); window.location.href='tableOurWorks.php';</script>";
    }
} catch (PDOException $e) {
    echo "<script>alert('Ошибка: " . htmlspecialchars($e->getMessage()) . "'); window.location.href='tableOurWorks.php';</script>";
}
?>
