<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверяем, передан ли ID отзыва
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tableReviews.php?error=Неверный ID отзыва");
    exit();
}

$id = (int)$_GET['id'];

// Проверяем подключение к БД
if (!$pdo) {
    header("Location: tableReviews.php?error=Ошибка подключения к базе данных");
    exit();
}

// Проверяем существование отзыва перед удалением
try {
    $stmt = $pdo->prepare("SELECT id FROM reviews WHERE id = ?");
    $stmt->execute([$id]);
    
    if (!$stmt->fetch()) {
        header("Location: tableReviews.php?error=Отзыв с ID $id не найден");
        exit();
    }
} catch (PDOException $e) {
    header("Location: tableReviews.php?error=Ошибка при проверке отзыва: " . urlencode($e->getMessage()));
    exit();
}

// Удаляем отзыв
try {
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
        header("Location: tableReviews.php?success=Отзыв #$id успешно удален");
    } else {
        header("Location: tableReviews.php?error=Не удалось удалить отзыв #$id");
    }
    exit();
} catch (PDOException $e) {
    header("Location: tableReviews.php?error=Ошибка при удалении: " . urlencode($e->getMessage()));
    exit();
}
?>