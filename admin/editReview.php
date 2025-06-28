<?php
require_once "../BdConnect.php";
include "./blade/menuAdmin.php";
include './check_admin.php';
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE id = ?");
    $stmt->execute([$id]);
    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$review) {
        echo "Отзыв не найден!";
        exit;
    }
} else {
    echo "Ошибка: Не указан ID!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_review = $_POST['review'];
    $new_status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE reviews SET review = ?, status = ? WHERE id = ?");
    if ($stmt->execute([$new_review, $new_status, $id])) {
        echo "<script>alert('Отзыв обновлен!'); window.location='tableReviews.php';</script>";
    } else {
        echo "<script>alert('Ошибка обновления!');</script>";
    }
}
?>
<head>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f4f6f8;
      color: #333;
      margin: 0;
      /* padding: 40px; */
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 30px;
    }

    form {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }

    textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      resize: vertical;
      margin-bottom: 20px;
    }

    select {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    button {
      background-color: #28a745;
      color: #fff;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #218838;
      transform: scale(1.05);
    }

    a {
      margin-left: 15px;
      color: #dc3545;
      text-decoration: none;
      font-weight: 500;
    }

    /* a:hover {
      text-decoration: underline;
    } */
  </style>
</head>

<h2>Редактирование отзыва</h2>
<form method="post">
    <label>Отзыв:</label><br>
    <textarea name="review" required><?php echo htmlspecialchars($review['review']); ?></textarea><br>

    <label>Статус:</label><br>
    <select name="status">
        <option value="pending" <?php echo $review['status'] == 'pending' ? 'selected' : ''; ?>>На модерации</option>
        <option value="published" <?php echo $review['status'] == 'published' ? 'selected' : ''; ?>>Опубликован</option>
    </select><br>

    <button type="submit">Сохранить</button>
    <a href="tableReview.php">Отмена</a>
</form>
