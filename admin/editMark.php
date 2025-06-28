<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Редактировать марку";

// Проверяем наличие ID марки
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tableMarks.php?error=Неверный ID марки");
    exit();
}

$id = (int)$_GET['id'];

// Получаем данные текущей марки
try {
    $stmt = $pdo->prepare("SELECT * FROM cooperation WHERE id_marka = ?");
    $stmt->execute([$id]);
    $mark = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mark) {
        header("Location: tableMarks.php?error=Марка не найдена");
        exit();
    }
} catch (Exception $e) {
    die("Ошибка при получении данных марки: " . $e->getMessage());
}

// Обработка формы редактирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../assets/img/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    
    // Если загружено новое изображение
    if ($_FILES['logotype']['size'] > 0) {
        $file = $_FILES['logotype'];
        
        // Проверка ошибок загрузки
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = "Ошибка загрузки файла: " . $file['error'];
        } 
        // Проверка типа файла
        elseif (!in_array($file['type'], $allowedTypes)) {
            $error = "Недопустимый тип файла. Разрешены только JPG, PNG и GIF.";
        }
        // Проверка размера файла
        elseif ($file['size'] > $maxFileSize) {
            $error = "Файл слишком большой. Максимальный размер: 2MB.";
        } else {
            // Генерируем уникальное имя файла
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFilename = uniqid('logo_') . '.' . $extension;
            $destination = $uploadDir . $newFilename;

            // Пытаемся переместить файл
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Удаляем старое изображение
                if (file_exists($uploadDir . $mark['logotype'])) {
                    unlink($uploadDir . $mark['logotype']);
                }
                $logotype = $newFilename;
            } else {
                $error = "Не удалось сохранить файл.";
            }
        }
    } else {
        // Оставляем старое изображение
        $logotype = $mark['logotype'];
    }
    
    if (!isset($error)) {
        try {
            $stmt = $pdo->prepare("UPDATE cooperation SET logotype = ? WHERE id_marka = ?");
            $stmt->execute([$logotype, $id]);
            
            header("Location: tableMarks.php?success=Марка успешно обновлена");
            exit();
        } catch (Exception $e) {
            $error = "Ошибка базы данных: " . $e->getMessage();
            // Удаляем загруженный файл при ошибке
            if (isset($newFilename) && file_exists($uploadDir . $newFilename)) {
                unlink($uploadDir . $newFilename);
            }
        }
    }
}
?>

<head>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f2f4f8;
      color: #333;
      margin: 0;
      /* padding: 40px; */
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 30px;
    }

    .form-container {
      max-width: 700px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .form-group {
      margin-bottom: 25px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 10px;
    }

    input[type="file"] {
      display: block;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .file-preview {
      display: none;
      margin-top: 10px;
      max-width: 200px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      border: 1px solid #ddd;
    }

    .current-image {
      margin-top: 20px;
    }

    .current-image p {
      font-size: 15px;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .current-image img {
      max-width: 200px;
      border-radius: 10px;
      border: 1px solid #ccc;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
      background-color: #ffc107;
      color: #000;
      padding: 12px 22px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
      background-color: #e0a800;
      transform: scale(1.03);
    }

    .cancel-link {
      display: inline-block;
      margin-left: 20px;
      color: #dc3545;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .cancel-link:hover {
      color: #b52a3a;
      text-decoration: underline;
    }

    .error {
      background-color: #f8d7da;
      color: #842029;
      padding: 12px 16px;
      border: 1px solid #f5c2c7;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
    }
  </style>
</head>

<main>
    <h2>Редактировать марку #<?php echo $id; ?></h2>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="editMark.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logotype">Новый логотип марки:</label>
                <input type="file" id="logotype" name="logotype" accept="image/jpeg,image/png,image/gif">
                <img id="preview" class="file-preview" src="#" alt="Предпросмотр">
                
                <div class="current-image">
                    <p>Текущий логотип:</p>
                    <img src="../assets/img/<?php echo htmlspecialchars($mark['logotype']); ?>" alt="Текущий логотип">
                </div>
            </div>
            
            <button type="submit" class="submit-btn">Сохранить изменения</button>
            <a href="tableMarks.php" class="cancel-link">Отмена</a>
        </form>
    </div>
</main>

<script>
// Скрипт для предпросмотра изображения перед загрузкой
document.getElementById('logotype').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    }
    
    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
