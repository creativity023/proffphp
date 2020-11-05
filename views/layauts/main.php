<?php
    /** @var string  $content*/
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<ul>
    <li><a href="/?c=user&a=index">Главная</a></li>
    <li><a href="/?c=user&a=all">Все пользователи</a></li>
    <li><a href="/?c=user&a=add">Добавить</a></li>
</ul>
    <?= $content ?>
</body>
</html>