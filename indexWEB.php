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
</head>

<body>

    <main>
        <section id="secCover">
            <div id="divCover">
                <button id="headButCover" disabled>ОБСЛУЖИВАНИЕ АВТО ЛЮКСОВОГО КЛАССА</button>
                <h1 id="titleCover">Премиальный сервис
                    для автомобилей, которые
                    заслуживают особого ухода</h1>
                <p id="textCover">
                    Мы специализируемся на заботе о люксовых автомобилях, обеспечивая спокойствие
                    и уверенность для владельцев, которым
                    важен каждый нюанс.</p>
                <p id="textCover1">Запишитесь на сервис сейчас и позвольте нам позаботиться
                    о вашем автомобиле так, как он того заслуживает.</p>
                <a href="#secForm" class="btnA"><button class="headBtn2">
                        <p class="textBtnHead">Оставить заявку</p>
                        <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                    </button></a>
            </div>
            <div id="imgCover">
                <img src="./assets/img/proba.png" alt="">
            </div>
        </section>

        <section id="secServices">
            <h1>Наши услуги</h1>
            <div id="divServices">
                <?php
                $sql = "SELECT id_service, name_service, content_services, image_services FROM services WHERE id_service <= 5;";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <a href="price-list.php">
                        <div class="service">
                            <img src="<?php echo './assets/img/' . htmlspecialchars($row['image_services']) . '.png'; ?>"
                                alt="<?php echo htmlspecialchars($row['name_service']); ?>" class="service-img">
                            <div class="service-info">
                                <h2><?php echo htmlspecialchars($row['name_service']); ?></h2>
                                <p class="service-content"><?php echo htmlspecialchars($row['content_services']); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
            <div id="butServices">
                <a href="price-list.php"><button class="headBtn2" style='width: 220px;'>
                        <p class="textBtnHead">Показать все</p>
                    </button></a>
            </div>
        </section>


        <section id="secChoose">
            <div class="chooseDiv1">
                <h2>Расскажем, почему выбирают нас</h2>
                <p id="chooseP">Мы стремимся к тому, чтобы каждый клиент был уверен в высоком качестве наших услуг. Вот
                    несколько
                    причин, почему владельцы автомобилей премиум-класса доверяют именно нам.</p>
                <a href="#secForm" class="btnA"><button class="headBtn2">
                        <p class="textBtnHead">Оставить заявку</p>
                        <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                    </button></a>
                <div class="progress-indicators">
                    <hr class="active">
                    <hr>
                    <hr>
                    <hr>
                </div>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper">
                    <?php
                    $classes = ['chooseDivBlue', 'chooseDivWhite'];
                    $classIndex = 0;
                    $sql = "SELECT id, icons, heading, text FROM cardChoose";
                    $stmt = $pdo->query($sql);
                    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach (array_chunk($cards, 2) as $slide): ?>
                        <div class="slide">
                            <?php foreach ($slide as $row): ?>
                                <div class="<?php echo $classes[$classIndex]; ?>">
                                    <img src="<?php echo './assets/img/' . htmlspecialchars($row['icons']); ?>" alt="">
                                    <h4><?php echo htmlspecialchars($row['heading']); ?></h4>
                                    <p><?php echo htmlspecialchars($row['text']); ?></p>
                                </div>
                                <?php $classIndex = 1 - $classIndex; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="secPartners">
            <h1>С кем мы работаем</h1>
            <p>Каждый автомобиль, доверенный нам, получает безупречное обслуживание, соответствующее его классу.
                Независимо от сложности задачи, мы обеспечим результат, на который вы можете рассчитывать.</p>
            <div id="marks">
                <?php
                $sql = "SELECT logotype FROM cooperation";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                    <img src="<?php echo './assets/img/' . htmlspecialchars($row['logotype']); ?>" class="markaLogo">

                <?php endwhile; ?>
            </div>
        </section>

        <section id="secWorks">
            <h1>Наши работы</h1>
            <div id="divWorks0">
                <div id="divWorks">
                    <p>Мы успешно работаем с самыми разными автомобилями премиум-класса.
                        Посмотрите наши крайние проекты.</p>
                    <a href="gallery.php"><button class="headBtn2" id="butWorks">Открыть галерею</button></a>
                </div>
                <div id="slider-container">
                    <div id="slider">
                        <?php
                        $sql = "SELECT image FROM ourWorks";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <img src="<?php echo './assets/img/' . htmlspecialchars($row['image']); ?>" class="imgWorks">
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <section id="secReviews">
            <h1>Отзывы</h1>
            <div id="divReviews">
                <div id="sliderContainer">
                    <?php
                    $sql = "SELECT name, review, rating FROM reviews WHERE status = 'published'";
                    $stmt = $pdo->query($sql);
                    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($reviews as $row): ?>
                        <div class="review">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="review-text">"<?php echo htmlspecialchars($row['review']); ?>"</p>
                            <p class="review-rating">Оценка: <?php echo htmlspecialchars($row['rating']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <?php include "form.php" ?>
    </main>
    <?php include "./blade/footer.php"; ?>
</body>

</html>