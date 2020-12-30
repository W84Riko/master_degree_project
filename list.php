<!DOCTYPE html>
<html lang="uk">
    <head>
        <title>Головна сторінка</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body onload="GetAllClasses()">   
        <header>
            <div>     
                <div id="logo">
                    <a href="index.php">Рубрикатор науково-технічної інформації</a>
                </div>
            </div>            
            <nav>
                <ul>
                    <li><a href="index.php">Головна</a></li>
                    <li><a href="list.php">Список рубрик</a></li>
                    <li class="profileLink"><a href="registration.php">Реєстрація</a></li>                 
                    <li class="profileLink"><a id="login">Увійти</a></li>
                </ul>
            </nav>                       
        </header> 
        <section id="mainContent">
            <form id="searchForm">
                <input type="text" placeholder="Фрагмент заголовку" name="searchField" id="searchField"/>
                <input type="button" value="Пошук" onclick="Search(this)"/>
            </form>
        </section>
        <br>
        <footer>
            <p>Перед використанням ресурсу рекомендується прочитати правила користування. Авторське право © 2020. Всі Права Захищені.</p>                        
        </footer>        
        <script src="js/list.js"></script>
    </body>
</html>