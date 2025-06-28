<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Добавить новую работу";

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notes = $_POST['notes'];
    $uploadDir = '../assets/img/works/'; // Папка для загрузки работ
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 3 * 1024 * 1024; // 3MB

    // Проверяем загруженный файл
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        
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
            $error = "Файл слишком большой. Максимальный размер: 3MB.";
        } else {
            // Создаем папку, если не существует
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Генерируем уникальное имя файла
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'work_' . time() . '.' . $extension;
            $destination = $uploadDir . $filename;

            // Пытаемся переместить файл
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                try {
                    // Сохраняем в базу данных
                    $stmt = $pdo->prepare("INSERT INTO ourWorks (image, notes) VALUES (?, ?)");
                    $stmt->execute(['works/'.$filename, $notes]);
                    
                    header("Location: tableOurWorks.php?success=Работа успешно добавлена");
                    exit();
                } catch (Exception $e) {
                    $error = "Ошибка базы данных: " . $e->getMessage();
                    // Удаляем загруженный файл при ошибке
                    if (file_exists($destination)) {
                        unlink($destination);
                    }
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
        background: #f7f9fc;
        margin: 0;
        /* padding: 20px; */
        color: #333;
    }

    main {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 30px;
    }

    h2 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #222;
        text-align: center;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
    }

    input[type="file"],
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    .requirements {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .file-preview {
        display: none;
        margin-top: 15px;
        max-width: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    .cancel-link {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #999;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .cancel-link:hover {
        color: #666;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
    }
</style>

</head>
<main>
    <h2>Добавить новую работу</h2>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="newWork.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Изображение работы:</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif" required>
                <div class="requirements">Допустимые форматы: JPG, PNG, GIF. Максимальный размер: 3MB.</div>
                <img id="preview" class="file-preview" src="#" alt="Предпросмотр">
            </div>
            
            <div class="form-group">
                <label for="notes">Описание работы:</label>
                <textarea id="notes" name="notes" placeholder="Введите описание работы..."></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Добавить работу</button>
            <a href="tableOurWorks.php" class="cancel-link">Отмена</a>
        </form>
    </div>
</main>

<script>
// Скрипт для предпросмотра изображения перед загрузкой
document.getElementById('image').addEventListener('change', function(e) {
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
