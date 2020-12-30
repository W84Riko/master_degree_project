<!DOCTYPE html>
<html lang="uk">
    <head>
        <title>Реєстрація</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <header>
            <div id="logo">     
                <a href="index.php">Рубрикатор науково-технічної інформації</a>
            </div>
            <nav id="menu">             

            </nav>
        </header>   
        <section id="registrationContainer">
            <form action="" method="post">
                <h2 id="registrationHeader">Реєстрація</h2>
                <label>Нікнейм</label>
                <br>
                <input type="text" name="nickname"/>
                <br>
                <label>Пароль</label>
                <br>
                <input type="text" name="password"/>
                <br>
                <label>Прізвище</label>
                <br>
                <input type="text" name="surname" />
                <br>
                <label>Ім'я</label>
                <br>
                <input type="text" name="name" />
                <br>
                <label>Електронна пошта</label>
                <br>
                <input type="text" name="email" />
                <br>
                <input type="submit" value="Зареєструвати" id="submitBtn"/>
            </form>
            <?php
            include_once 'register.php'; 
            ?>
        </section>
        <footer>
            Перед використанням ресурсу рекомендується прочитати правила користування. Авторське право © 2020. Всі Права Захищені.
        </footer>
        <script src="js/index.js"></script>
    </body>
</html>