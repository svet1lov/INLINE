<?php
require_once 'Controller.php';
use control\Controller;
// class Controller{
// 	function getJson($url)
// 		{
// 			$typeSql = [
// 				'integer' => 'INT',
// 				'string_S' => 'VARCHAR(255)',
// 				'string_L' => 'VARCHAR(1024)'];
// 			$data = file_get_contents($url);
// 			$jsonData = json_decode($data, true);
// 			$values = array_keys($jsonData[0]);
// 			$types = array();
// 			foreach ($values as $value) {
// 				$temp = $jsonData[0][$value];
// 				$request = gettype($temp) == 'string' ? strlen($jsonData[0][$value]) > 100 ? 'string_L' : 'string_S' : 'integer';
// 				array_push($types, $typeSql[$request]);

// 			}
// 			return ['values' =>$values, 'types' =>$types];
// 		}
// }
$conn_str = mysqli_connect('', 'root', '');
// Создаём новую базу данных
if (mysqli_select_db($conn_str, "entries")) {
 echo "База данных успешно создана";
} else {
 echo "База данных не создана";
 mysqli_query($conn_str, "CREATE DATABASE `entries` CHARACTER SET utf8 COLLATE utf8_general_ci;");
}
$url = 'https://jsonplaceholder.typicode.com/posts';

$request = Controller::getJsonSQL(Controller::getJson($url));
$values = $request['values'];
$types = $request['types'];
echo(Controller::createTable($conn_str, $values, $types, 'posts'));

$url = 'https://jsonplaceholder.typicode.com/comments';

$request = Controller::getJsonSQL(Controller::getJson($url));
$values = $request['values'];
$types = $request['types'];
echo(Controller::createTable($conn_str, $values, $types, 'comments'));
mysqli_query($conn_str, "ALTER TABLE `posts` ADD PRIMARY KEY(`id`);");
mysqli_query($conn_str, "ALTER TABLE `posts` ADD PRIMARY KEY(`id`);");
echo(var_dump(mysqli_query($conn_str, "ALTER TABLE `comments` ADD FOREIGN KEY (`postId`) REFERENCES `posts`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;")));
mysqli_close($conn_str);
?>