<?php 
include 'includes/config.php';
$sqlconfig = "SELECT * FROM config";
$queryconfig = $dbcon->prepare($sqlconfig);
$queryconfig->execute();
$config = $queryconfig->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<style>
	.cnbox {
		border-radius: 15px;
		padding: 10px;
	}
	

	/* ซ่อน up-down ใน input-number */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* ซ่อน up-down ใน input-number */
</style>

<head>



	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>ระบบรับสมัครนักเรียน - <?php echo $config->con_schoolname; ?> @<?php echo $config->con_year; ?></title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/chosen.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->


	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="assets/css/fonts.skr.css" />
	


	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />


	<script src="assets/js/ace-extra.min.js"></script>
	<!-- <link rel="stylesheet" href="assets/css/w3.css"> -->
	
	<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
</head>

