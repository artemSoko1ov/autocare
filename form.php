<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/styleForm.css">
</head>

<body>
    <section id="secForm">
        <div id="divForm">
            <h1>Свяжитесь с нами</h1>
            <div id="divForm1">
                <h2>МЫ ВСЕГДА ГОТОВЫ ПОМОЧЬ ВАМ И ОТВЕТИТЬ НА ВАШИ ВОПРОСЫ</h2>
                <div class="divForm2">
                    <div class="divForm_1">
                        <h4>Телефон</h4>
                        <p>+7 (999) 999-99-99<br>+7 (999) 999-99-99</p>
                    </div>
                    <div class="divForm_2">
                        <h4>Местоположение</h4>
                        <p>ул. Гагарина, 7, Челябинск<br>Пн-Пт: 9:00 - 18:00<br>Сб: 10:00 - 16:00</p>
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
            </div>
        </div>
        <form id="contactForm" action="send.php" method="post">
            <h3 class="formaHtext">Оставьте заявку прямо сейчас</h3>
            <p class="formaText">Оставьте свои контактные данные, и наш специалист свяжется с вами для консультации,
                записи на сервис или уточнения деталей.</p>
            <input type="text" name="name" id="nameInput" placeholder="Имя" required pattern="[А-Яа-яЁё\s]+"
                title="Только буквы и пробелы" oninput="this.value = this.value.replace(/[^А-Яа-яЁё\s]/g, '')">
            <input type="text" name="phone" placeholder="Номер телефона" required pattern="\d+" title="Только цифры"
                oninput="this.value = this.value.replace(/\D/g, '')" maxlength="11">
            <select name="service" id="formSelect" required>
                <option value="Диагностика">Диагностика</option>
                <option value="Тюнинг и настройка">Тюнинг и настройка</option>
                <option value="Техническое обслуживание">Техническое обслуживание</option>
                <option value="Заказ оригинальных запчастей">Заказ оригинальных запчастей</option>
                <option value="Шиномонтаж и балансировка">Шиномонтаж и балансировка</option>
            </select>
            <textarea name="message" placeholder="Комментарий"></textarea>
            <a href="#secForm"><button class="headBtn2">
                    <p class="textBtnHead">Оставить заявку</p>
                    <img src="./assets/img/vectorBtnHead.png" alt="" class="vectorBtnHead">
                </button></a>
        </form>
    </section>
    <div class="bg-modal" id="bgModal">
        <button class="close-modal" id="closeModal">&times;</button>
        <div id="reviewModal" class="modal">
            <div class="modal-content">
                <h2>Спасибо, что выбрали нас!</h2>
                <p>Мы будем рады вашему отзыву!</p>
                <input type="hidden" id="reviewName">
                <textarea id="reviewText" placeholder="Ваш отзыв"></textarea>
                <select id="reviewRating">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>
                <button id="submitReview">Отправить</button>
            </div>
        </div>
        <br>
        <a href="diagnostic_cards.php" id="butDiagnost"><button class="btnDiagnost">
                    <p class="textBtnHead">Диагностическая карта</p>
                </button></a>
    </div>
</body>

</html>