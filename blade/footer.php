<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="stylesheet" href="./assets/css/styleForm.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        @font-face {
            font-family: "Gilroy";
            src: url("./assets/fonts/Gilroy-Light.otf");
        }

        body {
            background-size: 100%;
            background-position: top center;
            background-repeat: no-repeat;
            background-color: #121212;
            overflow-x: hidden;
        }

        footer {
            font-family: "Gilroy";
            width: 95vw;
            height: 630px;
            margin: auto;
            border: 1px solid white;
            border-bottom: none;
            border-start-start-radius: 25px;
            border-start-end-radius: 25px;
            padding: 180px 340px 0px 340px;
            font-weight: 300;
            background-repeat: no-repeat;
            background-color: #111111;
            color: white;
        }

        #logotypeFooter {
            margin-bottom: 38px;
        }

        #firstFooter>a {
            text-decoration: none;
            color: white;
            font-size: 19px;
            font-weight: 400;
        }

        #firstFooter {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .polit {
            margin: 100px auto 0px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 16px;
        }

        .polit a {
            cursor: pointer;
            text-decoration: underline;
        }

        @media screen and (max-width: 1024px) {
            footer {
                font-family: "Gilroy";
                width: 95vw;
                height: 300px;
                border-bottom: none;
                border-start-start-radius: 15px;
                border-start-end-radius: 15px;
                padding: 50px 140px 0px 140px;
                font-weight: 300;
                background-repeat: no-repeat;
                background-color: #111111;
                color: white;
            }

            #logotypeFooter {
                width: 100px;
                margin-bottom: 18px;
            }

            #firstFooter>a {
                text-decoration: none;
                color: white;
                font-size: 14px;
                font-weight: 400;
            }

            #firstFooter {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .polit {
                margin: 10px auto 0px auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 12px;
                color: white;
            }
        }

        @media screen and (max-width: 768px) {
            footer {
                height: auto;
                padding: 20px 15px;
                border-top-right-radius: 15px;
                border-top-left-radius: 15px;
            }
        }

        @media screen and (max-width: 480px) {
            footer {
                height: auto;
                padding: 30px 15px;
                border-top-right-radius: 15px;
                border-top-left-radius: 15px;
            }

            #logotypeFooter {
                width: 80px;
                margin-bottom: 20px;
            }

            #firstFooter {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            #firstFooter>a {
                font-size: 14px;
                padding: 5px 0;
            }

            .divForm2 {
                gap: 20px;
                margin-top: 30px;
            }

            .divForm2 div {
                margin-bottom: 15px;
            }

            .divForm2 h4 {
                font-size: 16px;
                margin-bottom: 5px;
            }

            .divForm2 p {
                font-size: 14px;
                line-height: 1.4;
            }

            .divForm_4 {
                gap: 10px;
            }

            .divForm_4 a img {
                width: 24px;
                height: 24px;
            }

            .polit {
                flex-direction: column;
                gap: 10px;
                margin-top: 30px;
                text-align: center;
            }

            .polit a {
                font-size: 12px;
            }

            .headBtn2 {
                width: 100%;
                margin-top: 15px;
                padding: 8px 12px;
                font-size: 14px;
            }

            .textBtnHead {
                font-size: 14px;
            }

            .vectorBtnHead {
                width: 12px;
                height: 12px;
            }
        }
    </style>
</head>

<body>
    <footer>
        <div id="firstFooter">
            <a href="indexWEB.php"><img src="./assets/img/logotype.png" alt="" id="logotypeFooter"></a>
            <a href="indexWEB.php">О нас</a>
            <a href="price-list.php">Прайс-лист</a>
            <a href="reviews.php">Отзывы</a>
            <a href="contacts.php">Контакты</a>
            <a href="#secForm" class="btnA"><button class="headBtn2">
                    <p class="textBtnHead">Оставить заявку</p>
                    <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                </button></a>
        </div>
        <div class="divForm2">
            <div class="divForm_1">
                <h4>Телефон</h4>
                <p>+7 (999) 999-99-99<br>
                    +7 (999) 999-99-99</p>
            </div>
            <div class="divForm_2">
                <h4>Местоположение</h4>
                <p>ул. Гагарина, 7, Челябинск<br>
                    Пн-Пт: 9:00 - 18:00<br>
                    Сб: 10:00 - 16:00</p>
            </div>
            <div class="divForm_3">
                <h4>Эл. почта</h4>
                <p>stolux@gmail.com</p>
            </div>
            <div class="divForm_4">
                <h4>Социальные сети</h4>
                <a href="https://www.instagram.com/"><img src="./assets/img/instaIcon.png" alt=""></a>
                <a href="https://www.youtube.com/"><img src="./assets/img/youtubeIcon.png" alt=""></a>
                <a href="https://telegram.org/"><img src="./assets/img/telegramIcon.png" alt=""></a>
            </div>
        </div>
        <div class="polit">
            <a href="assets/img/Политика конфиденциальности.pdf" target="_blank">
                <p>Политика конфиденциальности</p>
            </a>
            <a href="assets/img/Политика обработки персональных данных.pdf" target="_blank">
                <p>Политика обработки персональных данных</p>
            </a>
        </div>
    </footer>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/scriptScroll.js"></script>
</body>

</html>