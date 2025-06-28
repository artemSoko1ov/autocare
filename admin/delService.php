<?php
include "./blade/menuAdmin.php";
include './check_admin.php';
include_once '../BdConnect.php';
$id = (int)$_GET['id'];
// Проверяем, существует ли такая услуга
try {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id_service = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        header("Location: tableServices.php?error=Услуга с ID $id не найдена");
        exit();
    }
} catch (Exception $e) {
    header("Location: tableServices.php?error=Ошибка при проверке услуги: " . urlencode($e->getMessage()));
    exit();
}
// Удаляем услугу
try {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id_service = ?");
    $stmt->execute([$id]);
    
    // Проверяем, была ли удалена запись
    if ($stmt->rowCount() > 0) {
        header("Location: tableServices.php?success=Услуга успешно удалена");
    } else {
        header("Location: tableServices.php?error=Не удалось удалить услугу");
    }
    exit();
} catch (Exception $e) {
    header("Location: tableServices.php?error=Ошибка при удалении: " . urlencode($e->getMessage()));
    exit();
}
?>