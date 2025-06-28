<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="icon" href="./assets/img/iconVklad.png">
    <link rel="stylesheet" href="./assets/css/styleScroll.css">
    <style>
        header {
            font-family: "Gilroy";
            width: 95vw;
            height: 140px;
            margin: auto;
            border: 1px solid white;
            border-top: none;
            border-end-start-radius: 25px;
            border-end-end-radius: 25px;
            padding: 64.37px 340px 25.69px 340px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        header>a {
            text-decoration: none;
            color: white;
            font-size: 19px;
            font-weight: 500;
        }

        #logotypeHeader {
            margin-bottom: 38px;
        }

        #buttonsHead {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 21px;
        }

        .headBtn1 {
            width: 50px;
            height: 50px;
            border-radius: 100%;
            border: none;
            background: linear-gradient(115deg, #2962FF, #193B99);
            background-size: 150% 100%;
            background-position: right;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-position 0.4s ease-in-out;
            cursor: pointer;
            font-weight: 400;
        }

        .headBtn1:hover {
            background-position: left;
        }

        a {
            text-decoration: none;
        }

        .headBtn2,
        #footBtn {
            font-weight: 400;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 271.89px;
            height: 50px;
            border-radius: 64.4px;
            border: none;
            background: linear-gradient(120deg, #2962fe, #4b7bff, #2962ff, #1b42ad, #112a70);
            background-size: 150% 100%;
            background-position: right;
            color: white;
            font-size: 21px;
            gap: 9px;
            cursor: pointer;
            transition: background-position 0.4s ease-in-out;
        }

        .headBtn2:hover {
            background-position: left;
        }

        #footBtn:hover {
            background-position: left;
        }

        html {
            scroll-behavior: smooth;
        }

        .burger-menu {
            display: none;
            cursor: pointer;
            flex-direction: column;
            justify-content: space-around;
            width: 30px;
            height: 25px;
            z-index: 100;
        }

        .burger-line {
            width: 100%;
            height: 3px;
            background-color: white;
            transition: all 0.3s ease;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            border-end-start-radius: 15px;
            border-end-end-radius: 15px;
            z-index: 99;
        }

        .mobile-menu a {
            color: white;
            padding: 10px 0;
            font-size: 18px;
        }

        .burger-menu.active .burger-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .burger-menu.active .burger-line:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active .burger-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .nav-links>a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: 500;
        }

        .nav-links {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        @media screen and (max-width: 1024px) {
            header {
                height: 80px;
                margin: auto;
                border: 1px solid white;
                border-top: none;
                border-end-start-radius: 15px;
                border-end-end-radius: 15px;
                padding: 24.37px 140px 15.69px 140px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            header>a {
                text-decoration: none;
                color: white;
                font-size: 14px;
                font-weight: 500;
            }

            #logotypeHeader {
                margin-top: 21px;
                width: 100px;
            }

            #buttonsHead {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 11px;
            }

            .headBtn1 {
                width: 25px;
                height: 25px;
            }

            .headBtn1 img {
                width: 15px;
            }

            .headBtn1:hover {
                background-position: left;
            }

            a {
                text-decoration: none;
            }

            .nav-links>a {
                text-decoration: none;
                color: white;
                font-size: 14px;
                font-weight: 500;
            }

            .nav-links {
                width: 100%;
            }

            .headBtn2,
            #footBtn {
                width: 171.89px;
                height: 100%;
                padding: 5px 0;
                border-radius: 64.4px;
                font-size: 14px;
                gap: 9px;
            }

            .headBtn2 img {
                width: 15px;
                height: 15px;
            }

            .headBtn2:hover {
                background-position: left;
            }

            #footBtn:hover {
                background-position: left;
            }
        }

        @media screen and (max-width: 768px) {
            header {
                height: 80px;
                padding: 10px 15px;
                border-end-start-radius: 15px;
                border-end-end-radius: 15px;
            }

            #logotypeHeader {
                width: 80px;
                margin: 0;
            }

            .headBtn2,
            #footBtn {
                padding: 10px 10px;
                font-weight: 400;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 160px;
                height: 25px;
                border-radius: 64.4px;
                border: none;
                font-size: 14px;
                gap: 6px;
                cursor: pointer;
                transition: background-position 0.4s ease-in-out;
            }
        }

        @media screen and (max-width: 480px) {
            header {
                padding: 10px 15px;
                height: 60px;
            }

            .nav-links,
            #buttonsHead {
                display: none;
            }

            .burger-menu {
                display: flex;
            }

            .mobile-menu.active {
                display: flex;
            }

            #logotypeHeader {
                width: 80px;
            }

            .headBtn2 {
                width: 140px;
                font-size: 12px;
            }

            .burger-line {
                height: 1px;
            }
        }
    </style>
</head>

<body>
    <div id="top"></div>
    <header>
        <a href="indexWEB.php"><img src="./assets/img/logotype.png" alt="" id="logotypeHeader"></a>

        <div class="nav-links">
            <a href="price-list.php">Прайс-лист</a>
            <a href="reviews.php">Отзывы</a>
            <a href="contacts.php">Контакты</a>
        </div>

        <div id="buttonsHead">
            <a href="tel:+78888888888"><button class="headBtn1"><img src="./assets/img/phoneBtn.png" alt=""
                        id="phoneBtn"></button></a>
            <a href="#secForm" class="btnA"><button class="headBtn2">
                    <p class="textBtnHead">Оставить заявку</p>
                    <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                </button></a>
        </div>

        <div class="burger-menu" onclick="toggleMenu()">
            <div class="burger-line"></div>
            <div class="burger-line"></div>
            <div class="burger-line"></div>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <a href="price-list.php">Прайс-лист</a>
            <a href="reviews.php">Отзывы</a>
            <a href="contacts.php">Контакты</a>
            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <a href="tel:+79999999999"><button class="headBtn1"><img src="./assets/img/phoneBtn.png" alt=""
                            id="phoneBtn"></button></a>
                <a href="#secForm" class="btnA"><button class="headBtn2">
                        <p class="textBtnHead">Оставить заявку</p>
                        <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                    </button></a>
            </div>
        </div>
    </header>

    <script>
        function toggleMenu() {
            const burgerMenu = document.querySelector('.burger-menu');
            const mobileMenu = document.getElementById('mobileMenu');

            burgerMenu.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        }
    </script>
</body>

</html>