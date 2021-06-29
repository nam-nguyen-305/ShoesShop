<?php
require_once ('../database/dbhelper.php');
$ProductId = '';
if (isset($_GET['ProductId'])) {
	$ProductId      = $_GET['ProductId'];
	$sql     = 'select * from products where ProductId = '.$ProductId;
	$products = executeSingleResult($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$products['ProductName']?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"><?=$products['ProductName']?></h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?=$products['Price']?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>