<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверяем, передан ли ID марки
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tableMarks.php?error=Неверный ID марки");
    exit();
}

$id = (int)$_GET['id'];

// Проверяем подключение к БД
if (!$pdo) {
    header("Location: tableMarks.php?error=Ошибка подключения к базе данных");
    exit();
}

// Получаем данные марки для удаления файла изображения
try {
    $stmt = $pdo->prepare("SELECT logotype FROM cooperation WHERE id_marka = ?");
    $stmt->execute([$id]);
    $mark = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mark) {
        header("Location: tableMarks.php?error=Марка с ID $id не найдена");
        exit();
    }
} catch (PDOException $e) {
    header("Location: tableMarks.php?error=Ошибка при проверке марки: " . urlencode($e->getMessage()));
    exit();
}

// Удаляем марку
try {
    $stmt = $pdo->prepare("DELETE FROM cooperation WHERE id_marka = ?");
    $stmt->execute([$id]);
    
    // Если запись удалена, удаляем файл изображения
    if ($stmt->rowCount() > 0) {
        $filePath = '../assets/img/' . $mark['logotype'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        header("Location: tableMarks.php?success=Марка #$id успешно удалена");
    } else {
        header("Location: tableMarks.php?error=Не удалось удалить марку #$id");
    }
    exit();
} catch (PDOException $e) {
    header("Location: tableMarks.php?error=Ошибка при удалении: " . urlencode($e->getMessage()));
    exit();
}
?>