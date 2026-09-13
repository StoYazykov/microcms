<?php
	if(isset($_POST["page"])) file_put_contents("./data/".$_POST["page"].".pml", $_POST["hdr"]."~".$_POST["c"]);
	header("Location: /?page=".($_POST["page"]?$_POST["page"]:"main"));
	exit;
?>
