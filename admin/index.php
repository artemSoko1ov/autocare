<?php
session_start(); // ВАЖНО: запускаем сессию первым делом

include "./blade/menuAdmin.php";
include_once '../BdConnect.php';
include './check_admin.php';


// Отзывы
$totalReviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$publishedReviews = $pdo->query("SELECT COUNT(*) FROM reviews WHERE status = 'published'")->fetchColumn();
$unpublishedReviews = $pdo->query("SELECT COUNT(*) FROM reviews WHERE status != 'published'")->fetchColumn();

// Партнеры (предположим таблица называется masters)
$totalCooperation = $pdo->query("SELECT COUNT(*) FROM cooperation")->fetchColumn();

// Записи (appointments)
$totalAppointments = $pdo->query("SELECT COUNT(*) FROM requests")->fetchColumn();
$scheduledAppointments = $pdo->query("SELECT COUNT(*) FROM requests WHERE status = 'scheduled'")->fetchColumn();
$completedAppointments = $pdo->query("SELECT COUNT(*) FROM requests WHERE status = 'completed'")->fetchColumn();
$canceledAppointments = $pdo->query("SELECT COUNT(*) FROM requests WHERE status = 'canceled'")->fetchColumn();

// Услуги
$totalServices = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();

// Наши работы
$totalWorks = $pdo->query("SELECT COUNT(*) FROM ourWorks")->fetchColumn();
?>
<head>
    <title>Статистика</title>
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

    .h1c {
        font-size: 32px;
        text-align: center;
        margin-bottom: 40px;
        color: #007bff;
        font-weight: 600;
    }

    .statistics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .review-stats {
        background: #ffffff;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .review-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 123, 255, 0.15);
    }

    .review-stats h3 {
        font-size: 20px;
        margin-bottom: 16px;
        color: #007bff;
    }

    .review-stats p {
        margin: 8px 0;
        font-size: 16px;
    }

    .review-stats strong {
        color: #333;
    }

    @media (max-width: 600px) {
        .h1c {
            font-size: 26px;
        }

        .review-stats {
            padding: 20px;
        }
    }
</style>

</head>
<main>
    <h1 class="h1c">Статистика</h1>

    <div class="statistics">
        <div class="review-stats">
            <h3>Отзывы</h3>
            <div>
            <p>Общее количество отзывов: <strong><?= $totalReviews ?></strong></p>
            <p>Опубликованные отзывы: <strong><?= $publishedReviews ?></strong></p>
            <p>Неопубликованные отзывы: <strong><?= $unpublishedReviews ?></strong></p></div>
        </div>

        <div class="review-stats">
            <h3>Партнеры</h3>
            <div>
            <p>Общее количество партнеров: <strong><?= $totalCooperation ?></strong></p></div>
        </div>

        <div class="review-stats">
            <h3>Записи</h3>
            <div>
            <p>Всего записей: <strong><?= $totalAppointments ?></strong></p>
            <p>Запланированные: <strong><?= $scheduledAppointments ?></strong></p>
            <p>Выполненные: <strong><?= $completedAppointments ?></strong></p>
            <p>Отмененные: <strong><?= $canceledAppointments ?></strong></p></div>
        </div>

        <div class="review-stats">
            <h3>Услуги</h3>
            <div>
            <p>Всего услуг: <strong><?= $totalServices ?></strong></p></div>
        </div>

        <div class="review-stats">
            <h3>Наши работы</h3>
            <div>
            <p>Общее количество: <strong><?php echo $totalWorks; ?></strong></p></div>
        </div>

    </div>
</main>