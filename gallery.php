<?php require_once "BdConnect.php";
include "./blade/header.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="stylesheet" href="./assets/css/style.css">
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
            src: url("../fonts/Gilroy-Light.otf");
        }

        body {
            background-image: url(./assets/img/BACKGROUND.png);
            background-size: 100%;
            background-position: top center;
            background-repeat: no-repeat;
            background-color: #121212;
            overflow-x: hidden;
        }

        main .h11 {
            margin-top: 70px;
            font-size: 48px;
            font-weight: 600;
        }

        main {
            padding: 0px 380px;
        }

        .work-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 70px;
        }
        .workCard  img{
            width: 90%;
            height: 230px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .workCard p{
            text-align: left;
            font-size: 16px;
            padding: 0 15px;
        }
        .workCard {
            padding: 20px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 22px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <main>
        <h1 class="h11">Галерея наших работ</h1>
        <div class="work-container">
            <?php
            $sql = "SELECT image, notes FROM ourWorks";
            $stmt = $pdo->query($sql);
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($reviews as $row): ?>
                <div class="workCard">
                    <img src="<?php echo './assets/img/' . htmlspecialchars($row['image']); ?>" class="imgWorks">
                    <p class="work-text"><?php echo htmlspecialchars($row['notes']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include "./blade/footer.php"; ?>

</body>

</html>