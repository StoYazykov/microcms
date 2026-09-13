<!DOCTYPE html>
<!--
	--- MicroCMS edit.php page - page editor. ---
	This page rendered by MicroCMS version 1.1.
	(C) StoYazykov, 2026.
-->
<html>
<head>
<meta charset="utf-8">
<title>Конструктор сайтов</title>
<link rel="stylesheet" href="styles.css">
</head>
<body bgcolor="#ffffff" onload="lp()">
<SCRIPT SRC="/kernel.js"></SCRIPT>
<div class="center">
<h1>Редактирование страницы&nbsp;<?php echo htmlspecialchars($_GET["page"]);?></h1>
<span id="WYSIWYG">
<button class="sbtn" onclick="bolditalic('b');"><b>Жирный текст</b></button>
<button class="sbtn" onclick="bolditalic('i');"><i>Курсив</i></button>
<button class="sbtn" onclick="insimage();">Картинка</button>
<button class="sbtn" onclick="bolditalic('-');">Выравнивание по центру</button>
<button class="sbtn" onclick="insbutt();">Кнопка</button>
<button class="sbtn" onclick="insaudio();">Аудиоплеер</button>
<button class="sbtn" onclick="bolditalic('code');">Код</button>
</span>
<br><br>
<div id="temp">
</div>
<?php
	$fp=file_get_contents("./data/".$_GET["page"].".pml");
	if(!$fp) {
		echo "<h1>Данной страницы не существует.</h1><br><br><button class=\"sbtn\" onclick=\"r('".$_GET["page"]."');\">Создать страницу &quote;";
		echo $_GET["page"]."&quote;!</button>";
		exit;
	}
	list($t, $fp)=explode("~", $fp, 2);
?>
<table align="center">
<tr>
<td>
<h1>Заголовок:</h1>
</td>
<td>
&nbsp;&nbsp;
</td>
<td width="85%">
<form action="save.php" method="post">
<textarea name="hdr" style="width:100%;height:100px;"><?php
echo $t;
?>
</textarea>
</td>
</tr>
</table>
<input type="hidden" name="page" value=
<?php
	echo $_GET["page"];
?>>
<textarea name="c" id="e" style="width: 98%; height: 400px;" oninput="lp()">
<?php
	echo $fp;
?>
</textarea>
<?php
?>
<h2>Предпросмотр</h2>
<h1 id="zx"></h1>
<div class="md" id="p" width="98%">
<?php
?>
</div>
<br>
<button type="submit" class="sbtn"><b>Сохранить</b></button>
</form>
</div>
</body>
</html>
