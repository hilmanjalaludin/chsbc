<?php $this->load->view("allreport/func_allreport"); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>

<style>

body {
	margin: auto 5px;
	padding: auto;
}
.table {
	border-collapse: collapse;
	font-family: sans-serif;
    white-space: nowrap;
    margin-bottom: 10px;
}
	
.table thead td {
	padding: 9px 13px;
	border: 1px solid #00DE00;
	background:#00FF00;
	color: #003500;
	font-weight: bold;
	font-size: 13px;
}


.table tbody td {
	width: 200px;
	border: 1px solid #ccc;
	font-size: 12px;
	padding: 3px 10px;
}

.table tbody td:first-child {
	text-align: center;
}


.header {
	margin: auto;
	text-align: center;
	font-family: sans-serif;
}

</style>
<body>

<?php 
/**
 * 	"title" => "Report E-Coaching " . $startdate . " - " . $enddate , 
	"startdate" => $startdate , 
	"enddate" => $enddate
 */
?>

<div class="header">
	<h2><?= $title; ?></h2>
</div>





