<?php

$data = "Saya Belajar PHP di SMKN 2 Buduran";
$isi = "Saya Hari Ini Belajar PHP";
$materi = "Materi Belajar PHP";
$list1 = "Variabel";
$list2 = "Array";
$list3 = "Pengujian";
$list4 = "Pengulangan";
$list5 = "Function";
$list6 = "Class";
$list7 = "Object";
$list8 = "Firework";
$list9 = "PHP & MYSQL";

$lists = ["Variabel","Array","Pengujian","Pengulangan","Function","Class","Object","FIrework","PHP & MYSQL"];

echo $data;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
	.kamar{
		text-align: center;
	}
	.list{
		display: flex;
		justify-content: center;
	}
</style>
</head>
<body>
	<div class="kamar">
		<h1><?php echo $data; ?></h1>
		<p><?php echo $isi; ?></p>
		<h2><?= $materi; ?></h2>
		<div class="list">
		<ol>
			<li><?= $lists[0]; ?></li>
			<P>Variabel adalah wadah atau tempat untuk menyimpan data</P>
			<p>Data bisa berupa text atau string bisa juga berupa angka atau numerik. Dan juga bisa gabungan anatara text,angka,dan simbol</p>
			<li><?= $lists[1]; ?></li>
			<li><?= $lists[2]; ?></li>
			<li><?= $lists[3]; ?></li>
			<li><?= $lists[4]; ?></li>
			<li><?= $lists[5]; ?></li>
			<li><?= $lists[6]; ?></li>
			<li><?= $lists[7]; ?></li>
			<li><?= $lists[8]; ?></li>
		</ol>
	</div>
	</div>
</body>
</html>