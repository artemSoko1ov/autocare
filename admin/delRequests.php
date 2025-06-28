<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
// Проверяем, передан ли ID заявки
if (!isset($_GET['id'])) {
    header("Location: tableRequests.php?error=Не указан ID заявки");
    exit();
}

$id = (int)$_GET['id'];

// Проверяем, существует ли такая заявка
try {
    $stmt = $pdo->prepare("SELECT id FROM requests WHERE id = ?");
    $stmt->execute([$id]);
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$request) {
        header("Location: tableRequests.php?error=Заявка с ID $id не найдена");
        exit();
    }
} catch (Exception $e) {
    header("Location: tableRequests.php?error=Ошибка при проверке заявки: " . urlencode($e->getMessage()));
    exit();
}

// Удаляем заявку
try {
    $stmt = $pdo->prepare("DELETE FROM requests WHERE id = ?");
    $stmt->execute([$id]);
    
    // Проверяем, была ли удалена запись
    if ($stmt->rowCount() > 0) {
        header("Location: tableRequests.php?success=Заявка #$id успешно удалена");
    } else {
        header("Location: tableRequests.php?error=Не удалось удалить заявку #$id");
    }
    exit();
} catch (Exception $e) {
    header("Location: tableRequests.php?error=Ошибка при удалении: " . urlencode($e->getMessage()));
    exit();
}
?>