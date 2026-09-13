<?php
	session_start();
	$ud="./upload/";
	$fn=basename($_FILES["uf"]["name"]);
	$tp = $ud.$fn;
	if(move_uploaded_file($_FILES["uf"]["tmp_name"], $tp)) {
	echo $fn;
	} else {
	echo "Ошибка загрузки! tp=$tp ; ud=$ud ; fn=$fn;";
	}
?>
