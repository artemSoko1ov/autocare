<?php
session_start();
session_unset(); // Очистка всех переменных сессии
session_destroy(); // Уничтожение сессии

header("Location: ../index.php"); // Перенаправление на главную страницу
exit();