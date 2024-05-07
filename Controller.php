<?php
namespace control;

class Controller{
	static function getJsonSQL($array)
		{
			$typeSql = [
				'integer' => 'INT',
				'string_S' => 'VARCHAR(255)',
				'string_L' => 'VARCHAR(1024)'];
			$values = array_keys($array[0]);
			$types = array();
			foreach ($values as $value) {
				$temp = $array[0][$value];
				$request = gettype($temp) == 'string' ? strlen($array[0][$value]) > 100 ? 'string_L' : 'string_S' : 'integer';
				array_push($types, $typeSql[$request]);

			}
			return ['values' =>$values, 'types' =>$types];
		}
		static function getJson($url)
		{
			$data = file_get_contents($url);
			$jsonData = json_decode($data, true);
			return $jsonData;
		}
		static function createTable($conn_str, $values, $types, $name)
		{
			$sql = 'CREATE TABLE IF NOT EXISTS '.$name.' (';
			foreach ($values as $key => $column) {
			 $sql .= $column . ' ' . $types[$key] . ', ';
			}
			$sql = substr($sql, 0, -2); // Удаляем последнюю запятую
			$sql .= ')';
			if (mysqli_query($conn_str, $sql)) {
			 return "Таблица успешно создана";
			} else {
			 return "Ошибка при создании таблицы: " . mysqli_error($conn_str);
			}
		}
		static function pushTable($conn_str, $values, $types, $name)
		{
			$type = implode(", ", $types);
			//return $type;
			$count = 0;
			$sql = "INSERT INTO ".$name." (".$type.") VALUES ";
			$value = '';
			foreach ($values as $row) {
				$count++;
				$value .= "('".implode("', '", $row)."'),";
			}
			$value = rtrim($value, ',');
			$sql .= $value;
			if (mysqli_query($conn_str, $sql)) {
				return $count;
			} else {
				return "Ошибка: ". mysqli_error($conn_str);
			}
		}
}