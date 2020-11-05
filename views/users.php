<?php
/** @var \App\models\User[]  $users*/
?>

<h1>Пользователи</h1>

<?php foreach ($users as $user): ?>
    Логин: <?= $user->login ?><br>
    <a href="/?c=user&a=one&id=<?= $user->id ?>">More..</a>
    <hr>
<?php endforeach; ?>
