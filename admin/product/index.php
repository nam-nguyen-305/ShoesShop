<?php
require_once ('../../database/dbhelper.php');
require_once ('../../common/utility.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Sản Phẩm</title>
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/sneakers-2/100/17-512.png" type="image/x-icon" />

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
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link" href="../category/">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
		<li class="nav-item">
            <a class="nav-link" href="../../index.php">Home</a>
        </li>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<a href="add.php">
					<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
				</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th width="150px">Thumbnail</th>
							<th>ProductName</th>
							<th>CategoryName</th>
							<th>Unit</th>
							<th>Price</th>
							<th>Size</th>
							<th>Brand</th>
							<th>Quantity</th>
							<th>TotalSellQuantity</th>
							<th width="50px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
<?php
//Lay danh sach danh muc tu database
$limit = 5;
$page  = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if ($page <= 0) {
	$page = 1;
}
$firstIndex = ($page-1)*$limit;

$sql         = 'select products.ProductId, products.thumbnail, 
				products.ProductName,products.Price,products.Unit, products.SIZE, products.Brand, products.Quantity, products.TotalSellQuantity,
				CategoryName from products left join categories ON (products.CategoryId = categories.CategoryId)'.' limit '.$firstIndex.', '.$limit;
$productList = executeResult($sql);

$sql         = 'select count(ProductId) as total from products where 1 ';
$countResult = executeSingleResult($sql);
$number      = 0;
if ($countResult != null) {
	$count  = $countResult['total'];
	$number = ceil($count/$limit);
}

$index = 1;
setlocale(LC_MONETARY, 'en_US');

foreach ($productList as $item) {
	echo '<tr>
				<td>'.(++$firstIndex).'</td>
				<td><img src="'.$item['thumbnail'].'" style="max-width: 100px"/></td>
				<td>'.$item['ProductName'].'</td>
				<td>'.$item['CategoryName'].'</td>
				<td>'.$item['Unit'].'</td>
				<td>'.number_format($item['Price']).'đ</td>
				<td>'.$item['SIZE'].'</td>
				<td>'.$item['Brand'].'</td>
				<td>'.$item['Quantity'].'</td>
				<td>'.$item['TotalSellQuantity'].'</td>
				<td>
					<a href="add.php?ProductId='.$item['ProductId'].'"><button class="btn btn-warning">Sửa</button></a>
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteProduct('.$item['ProductId'].')">Xoá</button>
				</td>
			</tr>';
}
?>
</tbody>
				</table>
				<!-- Bai toan phan trang -->
<?=paginarion($number, $page, '')?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteProduct(ProductId) {
			var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
			if(!option) {
				return;
			}

			console.log(ProductId)
			//ajax - lenh post
			$.post('ajax.php', {
				'ProductId': ProductId,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>
</html>