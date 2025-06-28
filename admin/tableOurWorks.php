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

        .add_btn {
            display: inline-block;
            margin-bottom: 20px;
        }

        .add_btn button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 18px;
            font-size: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add_btn button:hover {
            background-color: #0056b3;
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

        .table_admin img {
            max-width: 120px;
            max-height: 80px;
            object-fit: contain;
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn,
        .action-btn {
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
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: rgb(0, 99, 204);
        }
    </style>
</head>

<main>
    <h2>Все работы</h2>
    <a href="newWork.php" class="add_btn"><button>Добавить работу</button></a>
    <table border="1" class="table_admin">
        <tr>
            <th>Номер</th>
            <th>Фото</th>
            <th>Контент</th>
            <th>Действие</th>
        </tr>
        <?php
         try {
        $stmt = $pdo->query("SELECT * FROM ourWorks ");
        $works = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            if (count($works) > 0) {
                foreach ($works as $work) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($work['id_work']) . "</td>";
                    echo "<td><img src='"."../assets/img/".htmlspecialchars($work['image']) ."'></td>";
                    echo "<td>" . htmlspecialchars($work['notes']) . "</td>";
                    echo "<td class='action-btns'>
        <button onclick=\"window.location.href='editWork.php?id=" . $work['id_work'] . "'\" 
                class='btn edit-btn'>
            Изменить
        </button>
        <button onclick=\"if(confirm('Вы уверены, что хотите удалить эту работу?')) { window.location.href='delWork.php?id=" . $work['id_work'] . "' }\" 
                class='btn delete-btn'>
            Удалить
        </button>
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