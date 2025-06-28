<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Добавить новую услугу";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name_service'];
    $content = $_POST['content_services'];
    $price = $_POST['price_service'];
    
    // Генерируем имя для изображения (imgServices + следующий ID)
    try {
        // Получаем следующий ID
        $stmt = $pdo->query("SELECT MAX(id_service) as max_id FROM services");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $next_id = $result['max_id'] + 1;
        $image = "imgServices" . $next_id;
        
        // Вставляем новую запись
        $stmt = $pdo->prepare("INSERT INTO services (name_service, content_services, image_services, price_service) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $content, $image, $price]);
        
        header("Location: tableServices.php?success=1");
        exit();
    } catch (Exception $e) {
        $error = "Ошибка базы данных: " . $e->getMessage();
    }
}
?>
<head>
  <style>
    body {
      /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
      background-color: #f2f4f8;
      color: #333;
      margin: 0;
      /* padding: 40px; */
    }

    main {
      max-width: 700px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 30px;
    }

    .form-container {
      background-color: #ffffff;
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

    input[type="text"],
    textarea {
      width: 95%;
      padding: 12px 14px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
      transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    small {
      display: block;
      margin-top: 6px;
      font-size: 12px;
      color: #666;
    }

    .submit-btn {
      background-color: #007bff;
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
      background-color: #0056b3;
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
    <h2>Добавить новую услугу</h2>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="newService.php" method="post">
            <div class="form-group">
                <label for="name_service">Название услуги:</label>
                <input type="text" id="name_service" name="name_service" required>
            </div>
            
            <div class="form-group">
                <label for="content_services">Описание услуги:</label>
                <textarea id="content_services" name="content_services" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="price_service">Стоимость (руб.):</label>
                <input type="text" id="price_service" name="price_service" required>
                <small>Пример: "5 000", "от 10 000"</small>
            </div>
            
            <button type="submit" class="submit-btn">Добавить услугу</button>
            <a href="tableServices.php" class="cancel-link">Отмена</a>
        </form>
    </div>
</main>
