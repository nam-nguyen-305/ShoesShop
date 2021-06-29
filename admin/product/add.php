<?php
require_once ('../../database/dbhelper.php');

$ProductId = $ProductName = $CategoryId = $Unit = $Price = $SIZE = $Brand = $Quantity = $TotalSellQuantity = $thumbnail = '';
if (!empty($_POST)) {
	if (isset($_POST['ProductName'])) {
		$ProductName = $_POST['ProductName'];
		$ProductName = str_replace('"', '\\"', $ProductName);
	}
	if (isset($_POST['ProductId'])) {
		$ProductId = $_POST['ProductId'];
	}
	if (isset($_POST['CategoryId'])) {
		$CategoryId = $_POST['CategoryId'];
	}
	if (isset($_POST['Unit'])) {
		$Unit = $_POST['Unit'];
		$Unit = str_replace('"', '\\"', $Unit);
	}
	if (isset($_POST['Price'])) {
		$Price = $_POST['Price'];
		$Price = str_replace('"', '\\"', $Price);
	}
	if (isset($_POST['SIZE'])) {
		$SIZE = $_POST['SIZE'];
		$SIZE = str_replace('"', '\\"', $SIZE);
	}
	if (isset($_POST['Brand'])) {
		$Brand = $_POST['Brand'];
		$Brand = str_replace('"', '\\"', $Brand);
	}
	if (isset($_POST['Quantity'])) {
		$Quantity = $_POST['Quantity'];
		$Quantity = str_replace('"', '\\"', $Quantity);
	}
	if (isset($_POST['TotalSellQuantity'])) {
		$TotalSellQuantity = $_POST['TotalSellQuantity'];
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}


	if (!empty($ProductName)) {
		//Luu vao database
		if ($ProductId == '') {
			$sql = 'insert into products(CategoryId, ProductName, Unit, Price, SIZE, Brand, Quantity, TotalSellQuantity, thumbnail)
			 values('.$CategoryId.', "' . $ProductName . '", "' . $Unit . '", ' . $Price . ', ' . $SIZE . ', "'.$Brand.'", ' . $Quantity . ', 0, "' . $thumbnail . '")';
			 
			 echo $sql;
		} else {
			$sql = 'update products set ProductName = "' . $ProductName . '", CategoryId = ' . $CategoryId . ', Unit = "' . $Unit . '", Price = ' . $Price . ', Brand = "' . $Brand . '", Quantity = ' . $Quantity . ', thumbnail = "' . $thumbnail . '" where ProductId = ' . $ProductId;
			echo $sql;
		}

		execute($sql);

		header('Location: index.php');
		die();
	}
}

if (isset($_GET['ProductId'])) {
	$ProductId      = $_GET['ProductId'];
	$sql     = 'select * from products where ProductId = ' . $ProductId;
	$products = executeSingleResult($sql);
	if ($products != null) {
		$ProductName = $products['ProductName'];
		$Price       = $products['Price'];
		$thumbnail   = $products['thumbnail'];
		$CategoryId  = $products['CategoryId'];
		$Unit     	 = $products['Unit'];
		$SIZE    	 = $products['SIZE'];
		$Brand     	 = $products['Brand'];
		$Quantity    = $products['Quantity'];
		$TotalSellQuantity     = $products['TotalSellQuantity'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Thêm/Sửa Sản Phẩm</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- summernote -->
	<!-- include summernote css/js -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="../category/">Quản Lý Danh Mục</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php">Quản Lý Sản Phẩm</a>
		</li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="ProductName">Tên Sản Phẩm:</label>
						<input type="text" name="ProductId" value="<?= $ProductId ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="ProductName" name="ProductName" value="<?= $ProductName ?>">
					</div>
					<div class="form-group">
						<label for="Categories">Chọn Danh Mục:</label>
						<select class="form-control" name="CategoryId" id="CategoryId">
							<option>-- Lựa chọn danh mục --</option>
							<?php
							$sql          = 'select * from categories';
							$categoryList = executeResult($sql);

							foreach ($categoryList as $item) {
								if ($item['CategoryId'] == $CategoryId) {
									echo '<option selected value="'.$item['CategoryId'].'">' . $item['CategoryName'] . '</option>';
								} else {
									echo '<option value="'.$item['CategoryId'].'">' . $item['CategoryName'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="Price">Đơn vị:</label>
						<input required="true" type="text" class="form-control" id="Unit" name="Unit" value="<?= $Unit ?>">
					</div>
					<div class="form-group">
						<label for="Price">Giá Bán:</label>
						<input required="true" type="number" class="form-control" id="Price" name="Price" value="<?= $Price ?>">
					</div>
					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?= $thumbnail ?>" onchange="updateThumbnail()">
						<img src="<?= $thumbnail ?>" style="max-width: 200px" id="img_thumbnail">
					</div>
					<div class="form-group">
						<label for="SIZE">SIZE:</label>
						<input required="true" type="number" class="form-control" id="SIZE" name="SIZE" value="<?= $SIZE ?>">
					</div>
					<div class="form-group">
						<label for="Brand">Brand:</label>
						<textarea class="form-control" rows="1" name="Brand" id="Brand"><?= $Brand ?></textarea>
					</div>
					<div class="form-group">
						<label for="Quantity">Quantity:</label>
						<input required="true" type="number" class="form-control" name="Quantity" id="Quantity" value="<?= $Quantity ?>">
					</div>
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function updateThumbnail() {
			$('#img_thumbnail').attr('src', $('#thumbnail').val())
		}

		$(function() {
			//doi website load noi dung => xu ly phan js
			$('#content').summernote({
				height: 350
			});
		})
	</script>
</body>

</html>