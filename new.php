<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Конструктор сайтов</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="" method="GET">
<table>
<tr>
<td>
<b>Введите название новой страницы:</b>
</td>
<td>
<input type="text" name="npn">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<br>
<button type="submit" class="sbtn">
<b>
Создать страницу!
</b>
</button>
</td>
</tr>
</table>
</form>
<?php
	if(isset($_GET["npn"])) {
		file_put_contents("./data/".$_GET["npn"].".pml", "Страница \"".$_GET["npn"]."\"~Основная часть страницы \"".$_GET["npn"]."\"");
		header("Location: /?page=".$_GET["npn"]);
		exit;
	}
?>
</body>
</html>
