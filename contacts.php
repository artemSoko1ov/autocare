<?php require_once "BdConnect.php";
include "./blade/header.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <link rel="stylesheet" href="./assets/css/styleContacts.css">
</head>

<body>
    <main>
        <h1 class="h11">Контакты</h1>
        <?php include "form.php" ?>
        <iframe
            src="https://yandex.ru/map-widget/v1/?um=constructor%3A29e6fee15b4b1a027993cf454ed4f30696397e6c61f8282181e0825f7ab96dfa&amp;source=constructor"
            width="1137" height="473" frameborder="0"></iframe>
    </main>
    <?php include "./blade/footer.php"; ?>
</body>

</html>