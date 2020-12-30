<!DOCTYPE html>
<html lang="uk">
    <head>
        <title>Головна сторінка</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body onload="loadLoginWindowCreation()">   
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
            <h1>Правила користування сервісом</h1>
            <p>Ласкаво просимо до Рубрикатора науково-технічної інформації. Для ефективного використання ресурсу рекомендується перечитати наступні правила:</p>
            <p>1. Існує 2 поля для вводу ключових слів відповідно українською і англійською мовою. Ви можете вводити дані як в одне з полів так і в обидва для пошуку 2 різними мовами. Ключові слова і фрази в полях введення необхідно відділяти комами.</p>
            <p>2. Також існує 1 поле для пошуку рубрики за кодом рубрикатора науково-технічної інформації.</p>            
            <p>3. Для пошуку рубрики по УДК впишіть українською УДК і його номер, а англійською UDC і його номер.</p>
            <p>4. На сторінці "Список рубрик", куди можна перейти, натиснувши посилання в меню, ви можете знайти повну базу даних рубрикатора науково-технічної інформації. При загрузці там відображається повний список рубрика 1-го порядку. Для відображення рубрик наступного порядку натисніть на код рубрики попереднього порядку. Якщо рубрик наступного порядку не існує, завантаження нових рубрик не відбудеться.</p>
            <form action="" method="post" id="searchForm"> 
                <input type="text" placeholder="Пошук українською" name="searchField"/>
                <input type="text" placeholder="Пошук англійською"  name="searchFieldEng"/>
                <input type="checkbox" name="Classes" checked/>
                <label for="Classes">Класи</label>
                <input type="checkbox" name="Subclasses" checked/>
                <label for="Subclasses">Підкласи</label>
                <input type="checkbox" name="Groups" checked/>
                <label for="Groups">Групи</label>
                <input type="checkbox" name="Subgroups" checked/>
                <label for="Subgroups">Підгрупи</label>
                <input type="submit" value="Пошук за ключовими словами"/>
            </form>
            <form action="" method="post" id="searchForm"> 
                <input type="text" placeholder="Код НТІ" name="codeSearchField"/>
                <input type="submit" value="Пошук за кодом НТІ"/>
            </form>
            <section id="searchTables">           
            <?php
            include_once 'search.php'; 
            ?>
            </section>
        </section>
        <br>
        <footer>
            <p>Перед використанням ресурсу рекомендується прочитати правила користування. Авторське право © 2020. Всі Права Захищені.</p>                        
        </footer>        
        <script src="js/index.js"></script>
        <script src="js/list.js"></script>
    </body>
</html>