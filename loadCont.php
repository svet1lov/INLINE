<?php
require_once 'Controller.php';
use control\Controller;


$conn_str = mysqli_connect('', 'root', '');
if (mysqli_select_db($conn_str, "entries")) {
 echo "Подключение прошло успешно\n";
} else {
 echo "Произошла ошибка";
}
$url = 'https://jsonplaceholder.typicode.com/posts';
$post = Controller::getJson($url);
$types = Controller::getJsonSQL($post)['values'];
$p = Controller::pushTable($conn_str, $post, $types, 'posts');

$url = 'https://jsonplaceholder.typicode.com/comments';
$comments = Controller::getJson($url);
$types = Controller::getJsonSQL($comments)['values'];
$c = Controller::pushTable($conn_str, $comments, $types, 'comments');
print_r('Загружено '.$p.' записей и '.$c.' комментариев');