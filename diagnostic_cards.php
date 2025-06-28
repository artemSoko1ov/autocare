<?php
require_once "BdConnect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO diagnostic_cards 
    (owner_name, vin, license_plate, category, year, mileage, marka, Rama, Kuzov, PTS) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['owner_name'],
        $_POST['vin'],
        $_POST['license_plate'],
        $_POST['category'],
        $_POST['year'],
        $_POST['mileage'],
        $_POST['marka'],
        $_POST['Rama'],
        $_POST['Kuzov'],
        $_POST['PTS']
    ]);


    $last_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("SELECT * FROM diagnostic_cards WHERE id = ?");
    $stmt->execute([$last_id]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Диагностическая карта</title>
    <link rel="stylesheet" href="./assets/css/styleDiagnostic.css">

</head>

<body>
    <?php include "./blade/header.php"; ?>
    <main>
        <form id="diagnosticForm" action="" method="post">
            <h3 class="formaHtext">Заполните данные для диагностической карты</h3>
            <div class="inputDiv">
                <input type="text" name="owner_name" placeholder="ФИО владельца" required>
                <input type="text" name="vin" placeholder="VIN номер" required>
                <input type="text" name="license_plate" placeholder="Госномер" required>
                <input type="text" name="category" placeholder="Категория ТС" required>
                <input type="number" name="year" placeholder="Год выпуска" required>
                <input type="number" name="mileage" placeholder="Пробег" required>
                <input type="text" name="marka" placeholder="Марка, модель" required>
                <input type="text" name="Rama" placeholder="Номер рамы" required>
                <input type="text" name="Kuzov" placeholder="Номер кузова" required>
                <input type="text" name="PTS" placeholder="ПТС (серия, номер)" required>


            </div>
            <a href="#"><button class="headBtn2" id="butGet">Получить</button></a>
        </form>
        <br>
        <h2>Диагностическая карта</h2>
        <div class="document" id="document">
            <h3>Диагностическая карта <br>
                Certificate of periodic technical inspection</h3>
            <table id="secTable">
                <tr>
                    <td>
                        <h4 style="display: inline;">Пункт технического осмотра: </h4><span>ООО "AutoCare" 454010,
                            Челябинская обл, г Челябинск, ул
                            Гагарина, 7</span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="display: inline;">Первичная проверка: </h4><span>X</span>
                    </td>
                    <td>
                        <h4>Повторная проверка: </h4>
                    </td>
                </tr>
                <tr>
                    <td>

                        <h4 style="display: inline;">Регистрационный знак ТС: </h4>
                        <span><?= htmlspecialchars($card['license_plate']) ?></span>
                    </td>
                    <td>

                        <h4 style="display: inline;">Марка, модель ТС: </h4>
                        <span><?= htmlspecialchars($card['marka']) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="display: inline;">VIN: </h4>
                        <span><?= htmlspecialchars($card['vin']) ?></span>
                    </td>
                    <td>
                        <h4 style="display: inline;">Категория ТС: </h4>
                        <span><?= htmlspecialchars($card['category']) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>

                        <h4 style="display: inline;"><span>Номер рамы: </h4>
                        <?= htmlspecialchars($card['Rama']) ?></span>
                    </td>
                    <td>
                        <h4 style="display: inline;">Год выпуска: </h4>
                        <span><?= htmlspecialchars($card['year']) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="display: inline;">Номер кузова: </h4>
                        <span><?= htmlspecialchars($card['Kuzov']) ?></span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <h4 style="display: inline;">ПТС (серия, номер):</h4>
                        <span><?= htmlspecialchars($card['PTS']) ?></span>
                    </td>
                </tr>
            </table>
            <div class="tablee">
                <div class="num">№</div>
                <div class="thh">Параметры и требования, предъявляемые к транспортным средствам при проведении
                    технического
                    осмотра</div>
                <div class="null"> </div>
                <div class="num">№</div>
                <div class="thh">Параметры и требования, предъявляемые к транспортным средствам при проведении
                    технического
                    осмотра</div>
                <div class="null"> </div>
                <div class="num">№</div>
                <div class="thh">Параметры и требования, предъявляемые
                    к транспортным средствам при проведении технического осмотра
                </div>
                <div class="null"> </div>

                <div id="tormoz" center>
                    I. Тормозные системы
                </div>
                <div class="num">22</div>
                <div>Наличие и расположение фар и сигнальных фонарей в местах, предусмотренных конструкцией</div>
                <div class="null"> </div>
                <div class="num">42</div>
                <div>Работоспособность запоров бортов грузовой платформы и запоров горловин цистерн</div>
                <div class="null"> </div>
                <div class="num">1</div>
                <div>Соответствие показателей эффективности торможения и устойчивости торможения</div>
                <div class="null"> </div>
                <div id="IV">IV. Стеклоочистители и стеклоомыватели</div>
                <div class="num">43</div>
                <div>Работоспособность аварийного выключателя дверей и сигнала требования остановки</div>
                <div class="null"> </div>
                <div class="num">2</div>
                <div>Соответствие разности тормозных сил установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">23</div>
                <div>Наличие стеклоочистителя и форсунки стеклоомывателя ветрового стекла</div>
                <div class="null"> </div>
                <div class="num">44</div>
                <div>Работоспособность аварийных выходов, приборов внутреннего освещения салона, привода управления
                    дверями и сигнализации их работы</div>
                <div class="null"> </div>
                <div class="num">3</div>
                <div>Работоспособность рабочей тормозной системы автопоездов с пневматическим тормозным приводом в
                    режиме аварийного (автоматического) торможения</div>
                <div class="null"> </div>
                <div class="num">24</div>
                <div>Обеспечение стеклоомывателем подачи жидкости в зоны очистки стекла</div>
                <div class="null"> </div>
                <div class="num">45</div>
                <div>Наличие работоспособного звукового сигнального прибора</div>
                <div class="null"> </div>
                <div class="num">4</div>
                <div>Отсутствие утечек сжатого воздуха из колесных тормозных камер</div>
                <div class="null"> </div>
                <div class="num">25</div>
                <div>Работоспособность стеклоочистителей и стеклоомывателей</div>
                <div class="null"> </div>
                <div class="num">46</div>
                <div>Наличие обозначений аварийных выходов и табличек по правилам их использования. Обеспечение
                    свободного доступа к аварийным выходам</div>
                <div class="null"> </div>
                <div class="num">5</div>
                <div>Отсутствие подтеканий тормозной жидкости, нарушения герметичности трубопроводов или соединений в
                    гидравлическом тормозном приводе</div>
                <div class="null"> </div>
                <div id="V">V. Шины и колеса</div>
                <div class="num">47</div>
                <div>Наличие задних и боковых защитных устройств, соответствие их нормам</div>
                <div class="null"> </div>
                <div class="num">6</div>
                <div>Отсутствие коррозии, грозящей потерей герметичности или разрушением</div>
                <div class="null"> </div>
                <div class="num">26</div>
                <div>Соответствие высоты рисунка протектора шин установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">48</div>
                <div>Соответствие высоты рисунка протектора шин установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">7</div>
                <div>Отсутствие механических повреждений тормозных трубопроводов</div>
                <div class="null"> </div>
                <div class="num">27</div>
                <div>Отсутствие признаков непригодности шин к эксплуатации</div>
                <div class="null"> </div>
                <div class="num">49</div>
                <div>Наличие работоспособных предохранительных приспособлений у одноосных прицепов и прицепов, не оборудованных рабочей тормозной системой </div>
                <div class="null"> </div>
                <div class="num">8</div>
                <div>Отсутствие трещин остаточной деформации деталей тормозного привода</div>
                <div class="null"> </div>
                <div class="num">28</div>
                <div>Наличие всех болтов или гаек крепления дисков и ободьев колес</div>
                <div class="null"> </div>
                <div class="num">50</div>
                <div>Оборудование прицепов исправным устройством, поддерживающим
                    сцепную петлю дышла в положении, облегчающем сцепку и расцепку с тяговым автомобилем</div>
                <div class="null"> </div>
                <div class="num">9</div>
                <div>Исправность средств сигнализации и контроля тормозных систем</div>
                <div class="null"> </div>
                <div class="num">29</div>
                <div>Отсутствие трещин на дисках и ободьях колес</div>
                <div class="null"> </div>
                <div class="num">51</div>
                <div>Отсутствие продольного люфта в беззазорных тягово-сцепных устройствах с тяговой вилкой для
                    сцепленного с прицепом тягача</div>
                <div class="null"> </div>
                <div class="num">10</div>
                <div>Отсутствие набухания тормозных шлангов под давлением, трещин и видимых мест перетирания</div>
                <div class="null"> </div>
                <div class="num">30</div>
                <div>Отсутствие видимых нарушений формы и размеров крепежных отверстий в дисках колес</div>
                <div class="null"> </div>
                <div class="num">52</div>
                <div>Обеспечение тягово-сцепными устройствами легковых автомобилей беззазорной сцепки сухарей замкового
                    устройства с шаром</div>
                <div class="null"> </div>
                <div class="num">11</div>
                <div>Расположение и длина соединительных шлангов пневматического тормозного привода автопоездов</div>
                <div class="null"> </div>
                <div class="num">31</div>
                <div>Установка шин на транспортное средство в соответствии с требованиями</div>
                <div class="null"> </div>
                <div class="num">53</div>
                <div>Соответствие размерных характеристик сцепных устройств установленным требованиям</div>
                <div class="null"> </div>
                <div id="tormoz">II. Рулевое управление</div>
                <div id="VI">VI. Двигатель и его системы</div>
                <div class="num">54</div>
                <div>Оснащение транспортных средств исправными ремнями безопасности</div>
                <div class="null"> </div>
                <div class="num">12</div>
                <div>Работоспособность усилителя рулевого управления. Плавность изменения усилия при повороте рулевого
                    колеса</div>
                <div class="null"> </div>
                <div class="num">32</div>
                <div>Соответствие содержания загрязняющих веществ в отработавших газах транспортных средств
                    установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">55</div>
                <div>Наличие знака аварийной остановки</div>
                <div class="null"> </div>
                <div class="num">13</div>
                <div>Отсутствие самопроизвольного поворота рулевого колеса с усилителем рулевого управления от
                    нейтрального положения при работающем двигателе</div>
                <div class="null"> </div>
                <div class="num">33</div>
                <div>Отсутствие подтекания и каплепадения топлива в системе питания</div>
                <div class="null"> </div>
                <div class="num">56</div>
                <div>Наличие не менее двух противооткатных упоров</div>
                <div class="null"> </div>
                <div class="num">14</div>
                <div>Отсутствие превышения предельных значений суммарного люфта в рулевом управлении</div>
                <div class="null"> </div>
                <div class="num">34</div>
                <div>Работоспособность запорных устройств и устройств перекрытия топлива</div>
                <div class="null"> </div>
                <div class="num">57</div>
                <div>Наличие огнетушителей, соответствующих установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">15</div>
                <div>Отсутствие повреждения и полная комплектность деталей крепления рулевой колонки и картера рулевого
                    механизма</div>
                <div class="null"> </div>
                <div class="num">35</div>
                <div>Герметичность системы питания транспортных средств, работающих на газе. Соответствие газовых
                    баллонов установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">58</div>
                <div>Надежное крепление поручней в автобусах, запасного колеса, аккумуляторной батареи, сидений,
                    огнетушителей и медицинской аптечки</div>
                <div class="null"> </div>
                <div class="num">16</div>
                <div>Отсутствие следов остаточной деформации, трещин и других дефектов в рулевом механизме и рулевом
                    приводе</div>
                <div class="null"> </div>
                <div class="num">36</div>
                <div>Соответствие нормам уровня шума выпускной системы</div>
                <div class="null"> </div>
                <div class="num">59</div>
                <div>Работоспособность механизмов регулировки сидений</div>
                <div class="null"> </div>
                <div class="num">17</div>
                <div>Отсутствие устройств, ограничивающих поворот рулевого колеса, не предусмотренных конструкцией</div>
                <div class="null"> </div>
                <div id="VII">VII. Прочие элементы конструкции</div>
                <div class="num">60</div>
                <div>Наличие надколесных грязезащитных устройств, отвечающих установленным требованиям</div>
                <div class="null"> </div>
                <div id="III">III. Внешние световые приборы</div>
                <div class="num">37</div>
                <div>Наличие зеркал заднего вида в соответствии с требованиями</div>
                <div class="null"> </div>
                <div class="num">61</div>
                <div>Соответствие вертикальной статической нагрузки на тяговое устройство автомобиля от сцепной петли
                    одноосного прицепа (прицепа-роспуска) нормам</div>
                <div class="null"> </div>
                <div class="num">18</div>
                <div>Соответствие устройств освещения и световой сигнализации установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">38</div>
                <div>Отсутствие дополнительных предметов или покрытий, ограничивающих обзорность с места водителя.</div>
                <div class="null"> </div>
                <div class="num">62</div>
                <div>Работоспособность держателя запасного колеса, лебедки и механизма подъема-опускания запасного
                    колеса</div>
                <div class="null"> </div>
                <div class="num">19</div>
                <div>Отсутствие разрушений рассеивателей световых приборов</div>
                <div class="null"> </div>
                <div class="num">39</div>
                <div>Соответствие норме светопропускания ветрового стекла, передних боковых стекол и стекол передних
                    дверей</div>
                <div class="null"> </div>
                <div class="num">63</div>
                <div>Работоспособность механизмов подъема и опускания опор и фиксаторов транспортного положения опор
                </div>
                <div class="null"> </div>
                <div class="num">20</div>
                <div>Работоспособность и режим работы сигналов торможения</div>
                <div class="null"> </div>
                <div class="num">40</div>
                <div>Отсутствие трещин на ветровом стекле в зоне очистки водительского стеклоочистителя</div>
                <div class="null"> </div>
                <div class="num">64</div>
                <div>Соответствие каплепадения масел и рабочих жидкостей нормам</div>
                <div class="null"> </div>
                <div class="num">21</div>
                <div>Соответствие углов регулировки и силы света фар установленным требованиям</div>
                <div class="null"> </div>
                <div class="num">41</div>
                <div>Работоспособность замков дверей кузова, устройства обогрева и обдува ветрового стекла, противоугонного устройства</div>
                <div class="null"> </div>
                <div class="num">65</div>
                <div>Установка государственных регистрационных знаков в соответствии с требованиями</div>
                <div class="null"> </div>
            </div>
        </div>
        <br>
        <button onclick="printDiv('document')" id="printBut">Распечатать</button>
        <script>
            function printDiv(divId) {
                var content = document.getElementById(divId).innerHTML;
                var printWindow = window.open('', '', 'height=600,width=800');

                var styles = `

.document {
    background-color: white;
    width: 1100px;
    height: 1714px;
    margin: 30px auto;
    color: black !important;
    font-family: 'Times New Roman', Times, serif;
    padding: 24px;
}

h3 {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 7px 0;
    border: 1px solid black;
}

table,
th,
td {
    border: 1px solid black;
    padding: 1px;
}

.num {
    width: 30px;
    height: 30px;
}

.tablee {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(9, 1fr);
}

.tablee * {
    border: 1px solid black;
    height: 100%;
    padding: 0 3px;
    font-size: 13px;
    border-collapse: collapse;
}

.thh {
    font-weight: bold;
    text-align: center;
    width: 271px;
    padding: 2px;
}

.trr {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;

}

.null,
.num {
    width: 40px;
    text-align: center;
}

#tormoz {
    grid-column-start: 1;
    grid-column-end: 4;
    text-align: center;
    font-weight: bold;
}

#IV {
    grid-column-start: 4;
    grid-column-end: 7;
    text-align: center;
    font-weight: bold;
}

#V {
    grid-column-start: 4;
    grid-column-end: 7;
    text-align: center;
    font-weight: bold;
}

#VI {
    grid-column-start: 4;
    grid-column-end: 7;
    text-align: center;
    font-weight: bold;
}

#VII {
    grid-column-start: 4;
    grid-column-end: 7;
    text-align: center;
    font-weight: bold;
}

#III {
    grid-column-start: 1;
    grid-column-end: 4;
    text-align: center;
    font-weight: bold;
}
            `;

                printWindow.document.write('<html><head><title>Печать</title>');
                printWindow.document.write('<style>' + styles + '</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(content);
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                printWindow.onload = function () {
                    printWindow.print();
                    printWindow.close();
                };
            }
        </script>
    </main>
    <?php include "./blade/footer.php"; ?>
</body>

</html>