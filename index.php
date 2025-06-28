<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB</title>
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
            height: 100vh;
            width: 100vw;
            background-image: url(./assets/img/bg-contacts.png);
            background-size: 100%;
            background-position: top center;
            background-repeat: no-repeat;
            background-color: #121212;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }


        .headBtn2 {
            font-weight: 400;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 0 20px;
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

        a {
            text-decoration: none;
        }
        div{
            width: 40%;
            padding: 80px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            gap: 55px;
        }
    </style>
</head>

<body>
    <div>
        <a href="admin/admin_dashboard.php" class="btnA"><button class="headBtn2">
                <p class="textBtnHead">Административная часть</p>
            </button></a>
        <a href="indexWEB.php" class="btnA"><button class="headBtn2">
                <p class="textBtnHead">Сайт "AutoCare"</p>
            </button></a>
    </div>
</body>

</html>