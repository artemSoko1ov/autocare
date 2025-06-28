<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Добавить новую марку";

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../assets/img/'; // Папка для загрузки
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Проверяем загруженный файл
    if (isset($_FILES['logotype'])) {
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
            $filename = uniqid('logo_') . '.' . $extension;
            $destination = $uploadDir . $filename;

            // Пытаемся переместить файл
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                try {
                    // Сохраняем в базу данных
                    $stmt = $pdo->prepare("INSERT INTO cooperation (logotype) VALUES (?)");
                    $stmt->execute([$filename]);
                    
                    header("Location: tableMarks.php?success=Марка успешно добавлена");
                    exit();
                } catch (Exception $e) {
                    $error = "Ошибка базы данных: " . $e->getMessage();
                    // Удаляем загруженный файл при ошибке
                    unlink($destination);
                }
            } else {
                $error = "Не удалось сохранить файл.";
            }
       }
    } else {
        $error = "Файл не был загружен.";
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
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
    }

    input[type="file"] {
      display: block;
      padding: 10px 0;
      font-size: 14px;
    }

    .file-preview {
      display: none;
      margin-top: 15px;
      max-width: 200px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      border: 1px solid #ddd;
    }

    .submit-btn {
      background-color: #28a745;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
      background-color: #218838;
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
    <h2>Добавить новую марку</h2>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="newMark.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logotype">Логотип марки:</label>
                <input type="file" id="logotype" name="logotype" accept="image/jpeg,image/png,image/gif" required>
                <img id="preview" class="file-preview" src="#" alt="Предпросмотр">
            </div>
            
            <button type="submit" class="submit-btn">Добавить марку</button>
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