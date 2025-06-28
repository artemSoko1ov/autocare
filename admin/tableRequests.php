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


    @media (max-width: 768px) {
        .table_admin th,
        .table_admin td {
            font-size: 14px;
            padding: 10px;
        }

        .action-btns {
            flex-direction: column;
        }
    }
</style>
</head>
<main>
    <h2>Все записи</h2>
    <table border="1" class="table_admin">
        <tr>
            <th>Номер</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Услуга</th>
            <th>Сообщение</th>
            <th>Дата создания</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
        <?php
         try {
        $stmt = $pdo->query("SELECT * FROM requests ORDER BY created_at DESC");
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            if (count($requests) > 0) {
                foreach ($requests as $request) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($request['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['service']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['message']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($request['status']) . "</td>";
                    echo "<td class='action-btns'>
                    <button onclick=\"window.location.href='editRequests.php?id=".$request['id']."'\" class='btn edit-btn'>Изменить</button>
                    <button onclick=\"if(confirm('Вы уверены?')) { window.location.href='delRequests.php?id=".$request['id']."' }\" class='btn delete-btn'>Удалить</button>
                  </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' align='center'>Нет данных</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='6' align='center'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
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