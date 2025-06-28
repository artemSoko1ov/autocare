<?php
include "./blade/menuAdmin.php";
include './check_admin.php';
include_once '../BdConnect.php';


$title = "Cтраница администратора";

// Создаем объект подключения к базе данных
// $db = new DbConnect();
// $pdo = $db->pdo;

// Проверяем подключение
if (!$pdo) {
    die("Ошибка подключения к базе данных.");
}
?>

<head>
    <style>
        body {
    margin: 0;
    font-family: 'Montserrat', sans-serif;
    background-color: #f4f6f8;
    color: #333;
}

main {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

h2 {
    font-size: 28px;
    text-align: center;
    color: #007bff;
    margin-bottom: 30px;
}

.table_admin {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.table_admin th,
.table_admin td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    vertical-align: top;
}

.table_admin th {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}

.table_admin tr:hover {
    background-color: #f1f9ff;
}


.action-btns {
    display: flex;
    gap: 8px;
    
}

.btn {
    padding: 6px 12px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn:hover {
    transform: scale(1.05);
}

.edit-btn {
    background-color: #28a745;
    color: #fff;
}

.edit-btn:hover {
    background-color: #218838;
}

.delete-btn {
    background-color: #dc3545;
    color: #fff;
}

.delete-btn:hover {
    background-color: #c82333;
}

form button {
    padding: 6px 12px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

form button:hover {
    background-color: rgb(0, 99, 204);
    transform: scale(1.05);
}

    </style>
</head>
<main>
    <h2>Все отзывы</h2>
    <table border="1" class="table_admin">
        <tr>
            <th>Номер</th>
            <th>Имя</th>
            <th>Отзыв</th>
            <th>Рейтинг</th>
            <th>Статус</th>
            <th>Время</th>
            <th>Действие</th>
            <th>Публикация</th>
        </tr>
        <?php
        try {
            // Сортируем сначала по статусу (published выше), затем по дате (новые выше)
            $stmt = $pdo->query("SELECT * FROM reviews ORDER BY 
                                CASE WHEN status = 'published' THEN 0 ELSE 1 END,
                                created_at DESC");
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($reviews) > 0) {
                foreach ($reviews as $review) {
                    $rowClass = $review['status'] === 'published' ? 'published' : 'pending';
                    echo "<tr class='$rowClass'>";
                    echo "<td>" . htmlspecialchars($review['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($review['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($review['review']) . "</td>";
                    echo "<td>" . htmlspecialchars($review['rating']) . "</td>";
                    echo "<td>" . htmlspecialchars($review['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($review['created_at']) . "</td>";
                    echo "<td class='action-btns'>
                            <button onclick=\"window.location.href='editReview.php?id=" . $review['id'] . "'\" class='btn edit-btn'>Изменить</button>
                            <button onclick=\"if(confirm('Вы уверены?')) { window.location.href='delReview.php?id=" . $review['id'] . "' }\" class='btn delete-btn'>Удалить</button>
                          </td>";

                    if ($review['status'] === 'pending') {
                        echo "<td><form action='newReview.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id' value='" . $review['id'] . "'>
                                <button type='submit'>Опубликовать</button>
                              </form></td>";
                    } else {
                        echo "<td>Опубликовано</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' align='center'>Нет данных</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='8' align='center'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
    </table>
</main>

<?php
if (!empty($_GET['IDDELETE'])) {
    $id = (int) $_GET['IDDELETE'];
    try {
        if ($dog->delete($id)) {
            echo "<script>alert('Строка с № " . $id . " удалена!');</script>";
            echo '<meta http-equiv="refresh" content="1;URL=admin.php">';
        } else {
            echo "<script>alert('Ошибка удаления записи.');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Ошибка: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>
</body>

</html>