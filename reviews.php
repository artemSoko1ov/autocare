<?php require_once "BdConnect.php";
include "./blade/header.php";

$limit = 3;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_reviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$total_pages = ceil($total_reviews / $limit);

$sql = "SELECT name, review, rating FROM reviews WHERE status = 'published' ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="icon" href="./assets/img/iconVklad.png">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Gilroy";
            color: white;
        }

        @font-face {
            font-family: "Gilroy";
            src: url("./assets/fonts/Gilroy-Light.otf");
        }

        body {
            background-image: url(./assets/img/bg-contacts.png);
            background-size: 100%;
            background-position: top center;
            background-repeat: no-repeat;
            background-color: #121212;
            overflow-x: hidden;
        }

        main {
            padding: 0px 380px;
        }

        .h11 {
            margin-top: 70px;
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 50px;
        }

        .review-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }

        .review {
            border: 1px solid white;
            border-radius: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: start;
            padding: 30px;
        }

        .review h3,
        .review p {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .review-rating {
            font-weight: 600;
            font-size: 18px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-bottom: 80px;
        }

        .pagination a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border: 1px solid white;
            margin: 0 5px;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: white;
            color: black;
        }

        @media screen and (max-width: 1024px) {
            main {
                padding: 0px 170px;
            }

            .h11 {
                margin-top: 70px;
                font-size: 26px;
                font-weight: 600;
                margin-bottom: 50px;
            }

            .review-container {
                display: flex;
                flex-direction: column;
                gap: 20px;
                margin-bottom: 40px;
            }

            .review {
                border: 1px solid white;
                border-radius: 20px;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: start;
                padding: 30px;
            }

            .review h3,
            .review p {
                font-size: 16px;
                font-weight: 500;
                margin-bottom: 20px;
            }

            .review-rating {
                font-weight: 600;
                font-size: 18px;
            }

            .pagination {
                display: flex;
                justify-content: center;
                margin-bottom: 60px;
            }

            .pagination a {
                color: white;
                text-decoration: none;
                padding: 7px 12px;
                border: 1px solid white;
                margin: 0 5px;
                border-radius: 5px;
                font-size: 14px;
            }

            .pagination a.active {
                background-color: white;
                color: black;
            }
        }
        @media screen and (max-width: 768px) {
            main {
                padding: 0px 40px;
            }
            .h11 {
                margin-top: 40px;
                font-size: 26px;
                font-weight: 600;
                margin-bottom: 40px;
            }
        }
    </style>
</head>

<body>
    <main>
        <h1 class="h11">Отзывы</h1>
        <div class="review-container" id="secrev">
            <?php foreach ($reviews as $row): ?>
                <div class="review">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="review-text">"<?php echo htmlspecialchars($row['review']); ?>"</p>
                    <p class="review-rating">Оценка: <?php echo htmlspecialchars($row['rating']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </main>
    <?php include "./blade/footer.php"; ?>
</body>

</html>