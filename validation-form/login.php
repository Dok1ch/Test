<?php
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if (mb_strlen($email) < 2 || mb_strlen($email) > 99) {
    echo "Недопустимая длина e-mail!";
    exit();
} else if (mb_strlen($password) < 2 || mb_strlen($password) > 99) {
    echo "Недопустимая длина пароля!";
    exit();
}

$password = md5($password . "sadwdasd");

$my_sql = new mysqli('localhost', 'root', '', 'crm-system');

$result = $my_sql->query("SELECT * FROM `students` WHERE `student_email` = '$email' AND `student_password` = '$password'");
$user = $result->fetch_assoc();

if (!empty($user)) {
    setcookie('user', $user['name'], time() + 3600, "/");
} else {
    echo "Неправильный логин или пароль!";
    exit();
}



$my_sql->close();

header('Location: ../homepage.html');
