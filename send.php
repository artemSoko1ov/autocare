<?php
require_once "BdConnect.php";

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Некорректный метод запроса");
    }

    if (!isset($_POST['name'], $_POST['phone'], $_POST['service'])) {
        throw new Exception("Не все поля заполнены");
    }

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $service = trim($_POST['service']);
    $message = trim($_POST['message'] ?? '');

    $sql = "INSERT INTO requests (name, phone, service, message) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $phone, $service, $message]);

    echo json_encode(["success" => true, "name" => $name]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
