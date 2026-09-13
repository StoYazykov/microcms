<!DOCTYPE html>
<!--
	--- MicroCMS index.php page - viewer. ---
	
	This page rendered by MicroCMS version 1.1.
	(C) StoYazykov, 2026.
-->
<html>
<head>
<meta charset="utf-8">
<title><?php
$PAGE=isset($_GET["page"])?$_GET["page"]:"main";
echo $PAGE;
?></title>
<script>
var isM=(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|Mobile/i.test(navigator.userAgent));
if(isM) {
    document.write('<link rel="stylesheet" href="mobile.css">');
} else {
    document.write('<link rel="stylesheet" href="styles.css">');
}
var VA=(isM?100:50);
</script>
</head>
<body bgcolor="#ffff88">
<SCRIPT SRC="/kernel.js"></SCRIPT>
<div class="center">
<a href="/"><img style="border:2px solid black" src="/data/logo.jpg"></a>
<br><hr><br>
<select onchange="if(this.value) window.location.href='/?page='+this.value;">
<option value="">-- Выберите страницу --</option>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pgs=array_map(function($f) {
	return pathinfo($f, PATHINFO_FILENAME);
}, glob("./data/*.pml"));
//echo var_dump($pgs);
foreach($pgs as $J) {
	$S=($PAGE==$J)?"selected":"";
	echo "<option value=\"".$J."\" ".$S.">".$J."</option>";
}
?>
</select>
<button class="sbtn" onclick="r('new.php');"><font style="font-weight:bold;" size="6"><span style="color:#008800;font-weight:1000;">+</span>&nbsp;Создать страницу</font></button>
<?php
	function bbpp($text) {
		$c=0;
		return preg_replace_callback(
			'/\[audio="([^"]+)"\](.*?)\[\/audio\]/',
			function($m) use (&$c) {
				$url=$m[1];
				$cap=$m[2];
				$c++;
				return '
<span>
<table width="100%" border="0" style="border:1px solid black;background:#ffffff;padding:10px;">
<tr>
<td colspan="3" align="center">
<span style="font-size:45px;font-weight:bold;">'.$cap.'</span>
</td>
</tr>
<tr>
<td>
<audio id="p_'.$c.'" src="'.$url.'" ontimeupdate="ptupd('.$c.');" onloadedmetadata="ptmeta('.$c.');" onended="pte('.$c.');"></audio>
<button class="abtn" onclick="invaudio('.$c.');">
<img src="play.svg" width="100%" height="100%" id="play_'.$c.'">
</button>
</td>
<td>
<button class="abtn" onclick="pte('.$c.')">
<img src="stop.svg" width="100%" height="100%" id="stop_'.$c.'">
</button>
</td>
<td width="100%">
<input type="range" id="seek_'.$c.'" oninput="plmov('.$c.');" style="width:100%;" value="0" min="0" max="100" step="0.1">
</td>
</tr>
<tr>
<td colspan="3" align="center">
<span id="ct_'.$c.'" style="font-size:25px;">0:00</span>&nbsp;<span style="font-size:25px;">/</span>&nbsp;<span id="tt_'.$c.'" style="font-size:25px;">0:00</span>
</td>
</tr>
</table>
</span>
				';
			},
		$text
		);
	}
	function bbth($t) {
		$p=array(
			"[["=>"[",
			"]]"=>"]",
			"<"=>"&lt;",
			">"=>"&gt;",
			"[b]"=>"<b>",
			"[/b]"=>"</b>",
			"[i]"=>"<i>",
			"[code]"=>"<pre class=\"cod\">",
			"[/code]"=>"</pre>",
			"[/i]"=>"</i>",
			"[img]"=>"<img src=\"",
			"[/img]"=>"\">",
			"\n"=>"<br>",
			"[---]"=>"<hr>",
			"[-]"=>"<div class=\"center\">",
			"[/-]"=>"</div>"
		);
		$t=str_replace(array_keys($p), array_values($p), $t);
		$t=preg_replace(
		    '/\[button="(.*?)"(?:\s+(\S+))?(?:\s+(\S+))?\](.*?)\[\/button\]/',
		    '<button onclick="r(\'$1\')" style="color:$2; background:$3;">$4</button>',
		    $t
		);
		$t=preg_replace_callback(
		    "/<pre.*?>(.*?)<\/pre>/s",
		    function($matches) {
			return str_replace("<br>", "", $matches[0]);
		    },
		    $t
		);
		$t=bbpp($t);
		return $t;
	}
	$fp=file_get_contents("./data/".$PAGE.".pml");
	$PAGE=htmlspecialchars($PAGE);
	if(!$fp) {
		echo "<h1>Данной страницы не существует.</h1><br><br><button class=\"sbtn\" onclick=\"r('/new.php/?npn=".$PAGE."');\">Создать страницу <b>&quot;";
		echo $PAGE."&quot;</b>!</button>";
		exit;
	}
	list($t, $fp)=explode("~", $fp, 2);
	echo "<h1>".bbth($t)."</h1>";
?>
<button class="sbtn" onclick=
<?php
echo "\"r('/edit.php?page=".(isset($_GET["page"])?$_GET["page"]:"main")."')\"";
?>
><b>Редактировать</b></button>
<br><br>
<div class="md">
<?php
	echo bbth($fp);
?>
</div>
</div>
</body>
</html>
