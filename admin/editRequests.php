<?php
include_once '../BdConnect.php';
include "./blade/menuAdmin.php";
include './check_admin.php';
$title = "Редактировать заявку";

// Проверяем наличие ID заявки
if (!isset($_GET['id'])) {
    header("Location: tableRequests.php?error=Не указан ID заявки");
    exit();
}

$id = (int)$_GET['id'];

// Получаем данные заявки
try {
    $stmt = $pdo->prepare("SELECT * FROM requests WHERE id = ?");
    $stmt->execute([$id]);
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$request) {
        header("Location: tableRequests.php?error=Заявка с ID $id не найдена");
        exit();
    }
} catch (Exception $e) {
    die("Ошибка при получении данных заявки: " . $e->getMessage());
}

// Обработка формы редактирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $message = $_POST['message'];
    $status = $_POST['status'];
    
    try {
        $stmt = $pdo->prepare("UPDATE requests SET name = ?, phone = ?, service = ?, message = ?, status = ? WHERE id = ?");
        $stmt->execute([$name, $phone, $service, $message, $status, $id]);
        
        header("Location: tableRequests.php?success=Заявка #$id успешно обновлена");
        exit();
    } catch (Exception $e) {
        $error = "Ошибка базы данных: " . $e->getMessage();
    }
}
?>
<head>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f5f7fa;
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

    input[type="text"],
    input[type="tel"],
    select,
    textarea {
      width: 100%;
      padding: 12px 14px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
      transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    textarea {
      resize: vertical;
      min-height: 120px;
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
    <h2>Редактировать заявку #<?php echo $id; ?></h2>
    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="editRequests.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($request['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Номер телефона:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($request['phone']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="service">Услуга:</label>
                <select name="service" id="service" required>
                    <option value="Диагностика" <?php echo $request['service'] == 'Диагностика' ? 'selected' : ''; ?>>Диагностика</option>
                    <option value="Тюнинг и настройка" <?php echo $request['service'] == 'Тюнинг и настройка' ? 'selected' : ''; ?>>Тюнинг и настройка</option>
                    <option value="Техническое обслуживание" <?php echo $request['service'] == 'Техническое обслуживание' ? 'selected' : ''; ?>>Техническое обслуживание</option>
                    <option value="Заказ оригинальных запчастей" <?php echo $request['service'] == 'Заказ оригинальных запчастей' ? 'selected' : ''; ?>>Заказ оригинальных запчастей</option>
                    <option value="Шиномонтаж и балансировка" <?php echo $request['service'] == 'Шиномонтаж и балансировка' ? 'selected' : ''; ?>>Шиномонтаж и балансировка</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="message">Комментарий:</label>
                <textarea id="message" name="message"><?php echo htmlspecialchars($request['message']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Статус:</label>
                <select name="status" id="status" required>
                    <option value="scheduled" <?php echo $request['status'] == 'scheduled' ? 'selected' : ''; ?>>Запланировано</option>
                    <option value="completed" <?php echo $request['status'] == 'completed' ? 'selected' : ''; ?>>Выполнено</option>
                    <option value="canceled" <?php echo $request['status'] == 'canceled' ? 'selected' : ''; ?>>Отменено</option>
                </select>
            </div>
            
            <button type="submit" class="submit-btn">Сохранить изменения</button>
            <a href="tableRequests.php" class="cancel-link">Отмена</a>
        </form>
    </div>
</main>
