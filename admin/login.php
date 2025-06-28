<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход для администратора</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background: #f4f6f8;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form#form_admin {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h2.c {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        color: #333;
    }

    .input {
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        outline: none;
    }

    #button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 480px) {
        form#form_admin {
            padding: 30px 20px;
        }
    }
</style>

</head>

<body>

    <form id="form_admin" action="admin_dashboard.php" method="post">
        <h2 class="montserrat c">Вход администратора</h2>
        <input class="input" type="text" name="login" placeholder="Логин" required>
        <input class="input" type="password" name="password" placeholder="Пароль" required>
        <button id="button" type="submit">Войти</button>

    </form>
    </div>
</body>

</html>