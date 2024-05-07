<?php
// Подключение к базе данных
$conn_str = mysqli_connect('', 'root', '');
if (mysqli_select_db($conn_str, "entries")) {
 //echo "Подключение прошло успешно\n";
} else {
 //echo "Произошла ошибка";
}
// Запрос к базе данных
$sql = "SELECT * FROM comments WHERE body LIKE '%".$_GET['text']."%'";
$stmt = mysqli_query($conn_str, $sql);

// Получение результатов запроса
$results = $stmt->fetch_all(MYSQLI_ASSOC);
$id = array();
$comm = array();
foreach ($results as $result) {
	$comm[$result['postId']][] = $result;
 //echo var_dump($result) . "<br>";
 if(!in_array($result['postId'], $id))
 	array_push($id, $result['postId']);
}
// echo 'coments'.var_dump($comm);
// echo 'id'.var_dump($id);
// echo'</pre>';
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII=" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Результаты поиска по запросу "<?=$_GET['text']?>"</title>
    <style>
         main 
         {
            padding-top: 25%;
         }
         .error_title
         {
         	margin: auto;
         	font-size: 6rem;
         	color: #840d06;
         }
         .container
         {
            width: 70%;
            margin: auto;
         }
          .invitation__title {
             font-size: 3rem;
             width: 100%;
             margin-bottom: 1rem;
           }
           .invitation__text {
             max-width: 100%;
             margin-bottom: 2rem;
             font-size: 1.6rem;
             font-style: normal;
             font-weight: 200;
             line-height: 130%;
           }
           .invitation__form-inner
           {
             max-width: 100%;
             margin-bottom: 1rem;
             font-size: 1.6rem;
             font-style: normal;
             font-weight: 200;
             line-height: 130%;
           }
           .invitation__wrapper { 
              display: flex;
            }
            .invitation__left
            {
               margin-right: 10rem;
            }
            .all-btn {
              display: flex;
              align-items: center;
              border-radius: 5rem;
              background: #840d06;
              padding: 0.6rem 0.6rem 0.6rem 2.4rem;
              overflow: hidden;
              font-size: 0.8rem;
              font-style: normal;
              font-weight: 500;
              color: #fff;
              line-height: 110%;
            }
            .all-btn span {
              margin-right: 1rem;
              position: relative;
            }
            .all-btn__arrow {
              width: 1.4rem;
              height: 1.4rem;
              border-radius: 50%;
              display: flex;
              justify-content: center;
               align-items: center;
              background: #f9f9f8;
              margin-left: 1.9rem;
            }
            .all-btn__arrow svg {
              width: 1.3rem;
              height: 2.4rem;
              position: relative;
            }
            .all-btn:hover {
                cursor: pointer;
               }
            .all-btn:disabled {
               opacity: 0.5;
               background: #808080;
               cursor: not-allowed;
               }

            .all-btn:disabled .all-btn__arrow path
            {
               opacity: 0.5;
               stroke: #808080;
            }
    </style>
</head>
<main>
	<?if(!empty($comm) && !empty($id)):
		$idString = implode(',', $id);
		$sql = "SELECT * FROM posts WHERE id IN ($idString)";
		$stmt = mysqli_query($conn_str, $sql);
		$results = $stmt->fetch_all(MYSQLI_ASSOC);
		foreach ($results as $keyForTitle => $result):?>
			<div class="invitation__title"><?='Запись № '.($keyForTitle+1).' Заголовок: '.$result['title']?></div>
			<?foreach ($comm[$result['id']] as $keyForComm => $coment):?>
				<div class="invitation__text"><?='Комментарий №'.($keyForComm+1).' от пользователя '.$coment["email"]?>
				<p><?="'".$coment["body"]."'"?></p></div>
			<?endforeach;
		endforeach;
	else:?>
	        <div>
		         <div class="invitation__wrapper">
					<div class="error_title"><?='Ничего не найдено :('?></div>
				</div>
		    </div>
	<?endif?>
</main>
