<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .head {
            background-color: #007bff;
            padding: 16px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 30px;
        }

        nav ul a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s;
        }

        nav ul a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        nav ul a.active {
            background-color: white;
            color: #007bff;
            font-weight: 600;
        }

        a[name="exit"] {
            background-color: rgb(205, 14, 0);
            width: 55px;
        }

        a[name="exit"]:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        @media (max-width: 600px) {
            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>

</head>

<body>
    <?php
    $current = basename($_SERVER['PHP_SELF']);
    ?>

    <div class="head">
        <nav>
            <ul>
                <a href="index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">Главная</a>
                <a href="tableRequests.php" class="<?= $current == 'tableRequests.php' ? 'active' : '' ?>">Записи</a>
                <a href="tableReviews.php" class="<?= $current == 'tableReviews.php' ? 'active' : '' ?>">Отзывы</a>
                <a href="tableServices.php" class="<?= $current == 'tableServices.php' ? 'active' : '' ?>">Услуги</a>
                <a href="tableMarks.php" class="<?= $current == 'tableMarks.php' ? 'active' : '' ?>">Партнеры</a>
                <a href="tableOurWorks.php" class="<?= $current == 'tableOurWorks.php' ? 'active' : '' ?>">Наши
                    работы</a>
                <a href="logout.php" name="exit">Выйти</a>
            </ul>
        </nav>
    </div>

</body>

</html>