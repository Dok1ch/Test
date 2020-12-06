<?php
$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$patronymic = filter_var(trim($_POST['patronymic']), FILTER_SANITIZE_STRING);
$role = filter_var(trim($_POST['role']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
$age = filter_var(trim($_POST['age']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if (mb_strlen($surname) < 2 || mb_strlen($surname) > 99) {
    echo "Недопустимая длина фамилии!";
    exit();
} else if (mb_strlen($name) < 2 || mb_strlen($name) > 99) {
    echo "Недопустимая длина имени!";
    exit();
} else if (mb_strlen($email) < 2 || mb_strlen($email) > 99) {
    echo "Недопустимая длина почты!";
    exit();
}

$password = md5($password . "sadwdasd");

$my_sql = new mysqli('localhost', 'root', '', 'crm-system');

if (strcasecmp($role, "student") == 0) {
    $my_sql->query("INSERT INTO `students` (`student_id`, `student_surname`, `student_name`, `student_patronymic`, `student_email`, `student_phone`, `student_age`, `student_password`) VALUES(NULL, '$surname', '$name', '$patronymic', '$email', '$phone', '$age', '$password')");
    echo $phone;
} else if (strcasecmp($role, "parent") == 0) {
    echo "parent";
} else if (strcasecmp($role, "teacher") == 0) {
    echo "teacher";
}


$my_sql->close();

header('Location: /');
