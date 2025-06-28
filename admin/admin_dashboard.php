<?php
session_start();

$admin_login = 'adm';
$admin_password = 'adm';

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($login === $admin_login && $password === $admin_password) {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Неверный логин или пароль';
        header('Location: admin_dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход администратора</title>
</head>

<?php if (!empty($error)) echo "<h2 class='error'>$error</h2>";
require_once 'login.php';
?>

</html>