<?php require_once "BdConnect.php";
include "./blade/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="stylesheet" href="./assets/css/stylePrice.css">
</head>

<body>
    <main>
        <div class="priceText">
            <h1>Прайс–лист на наши услуги</h1>
            <p class="p1">Мы предлагаем прозрачное ценообразование и гарантируем высочайшее качество обслуживания вашего
                автомобиля</p>
            <br>
            <p class="p2">Ознакомьтесь с нашим прайс-листом на основные услуги</p>
        </div>

        <table>
            <thead>
                <td class="thd1">Популярные услуги</td>
                <div class="thin-line"></div>
                <td class="thd2">RUB</td>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM services WHERE id_service IN (1, 3) OR id_service BETWEEN 11 AND 18;";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td class="td1"><?php echo htmlspecialchars($row['name_service']); ?></td>
                        <td class="td2"><?php echo htmlspecialchars($row['price_service']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="thin-line"></div>
        <a href="#secForm" class="btnA"><button class="headBtn2" id="butPrice">
                <p class="textBtnHead">Оставить заявку</p>
                <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
            </button>
        </a>
        <table>
            <thead>
                <td class="thd1">Дополнительные услуги</td>
                <div class="thin-line"></div>
                <td class="thd2">RUB</td>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM services WHERE id_service >= 19;";
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td class="td1"><?php echo htmlspecialchars($row['name_service']); ?></td>
                        <td class="td2"><?php echo htmlspecialchars($row['price_service']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="thin-line"></div>
        <section id="secVip">
            <h2>VIP–услуги</h2>
            <img src="./assets/img/vipGroup.png" alt="">

            <div>
                <p class="pVip1">Примечания:</p>
                <ul>
                    <li>Окончательная стоимость услуг зависит от марки, модели автомобиля и сложности работ</li>
                    <li>Все работы
                        выполняются с использованием оригинальных запчастей или запчастей премиум-класса.</li>
                    <li>В стоимость входит
                        гарантия на все виды выполненных работ.</li>
                </ul>
            </div>
        </section>
        <?php include "form.php" ?>
    </main>
    <?php include "./blade/footer.php"; ?>
</body>

</html>