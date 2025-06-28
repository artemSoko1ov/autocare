<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Редактировать работу";

// Проверка наличия ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Некорректный ID.");
}

$id = (int) $_GET['id'];

// Получение текущих данных работы
try {
    $stmt = $pdo->prepare("SELECT * FROM ourWorks WHERE id_work = :id");
    $stmt->execute(['id' => $id]);
    $work = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$work) {
        die("Работа не найдена.");
    }
} catch (PDOException $e) {
    die("Ошибка: " . htmlspecialchars($e->getMessage()));
}

// Обработка формы
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $notes = $_POST['notes'];
    $imageName = $work['image']; // Оставим текущее изображение, если новое не загружено

    // Обработка загрузки нового изображения
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = '../assets/img/';
        $imageName = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "<script>alert('Ошибка загрузки изображения.');</script>";
            $imageName = $work['image']; // Вернуть старое изображение
        }
    }

    // Обновление данных в БД
    try {
        $stmt = $pdo->prepare("UPDATE ourWorks SET notes = :notes, image = :image WHERE id_work = :id");
        $stmt->execute([
            'notes' => $notes,
            'image' => $imageName,
            'id' => $id
        ]);

        echo "<script>alert('Запись обновлена успешно.'); window.location.href='tableOurWorks.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Ошибка: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        /* padding: 20px; */
        color: #333;
    }

    main {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #222;
        font-size: 26px;
        margin-bottom: 25px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    label {
        font-weight: bold;
        margin-bottom: 6px;
    }

    textarea {
        resize: vertical;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    input[type="file"] {
        padding: 10px;
        font-size: 16px;
    }

    img {
        max-width: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: white;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

</head>
<main>
    <h2>Редактировать работу №<?= htmlspecialchars($id) ?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Заметки:</label><br>
        <textarea name="notes" rows="5" cols="50"><?= htmlspecialchars($work['notes']) ?></textarea><br><br>

        <label>Текущее изображение:</label><br>
        <img src="../assets/img/<?= htmlspecialchars($work['image']) ?>" width="150"><br><br>

        <label>Новое изображение (если нужно заменить):</label><br>
        <input type="file" name="image"><br><br>

        <input type="submit" value="Сохранить изменения">
    </form>
</main>

</body>
</html>
