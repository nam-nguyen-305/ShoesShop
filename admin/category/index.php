<?php
require_once ('../../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý danh mục</title>
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
            <a class="nav-link active" href="#">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../product">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../index.php">Home</a>
        </li>
        
    </ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản lý danh mục </h2>
			</div>
			<div class="panel-body">
            <a href="add.php">
                <button class="btn btn-success" style="
                margin-bottom: 15px;"> Thêm thể loại </button>
            </a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width='15px'>STT</th>
                <th width='50px'>Thể loại</th>
                <th width='10px'></th>
                <th width='20px'></th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = 'select * from categories';
$categoryList = executeResult($sql);

$index =1;
foreach ($categoryList as $item){
    echo ' <tr>
                <td>'.($index++).'</td>
                <td>'.$item['CategoryName'].'</td>
                <td>
                    <a href="add.php?CategoryId='.$item['CategoryId'].'">
                        <button class="btn btn-warning"> Sửa </button>
                    </a>
                </td>
                <td>
                    <button class="btn btn-danger" onclick= "deleteCategories('.$item['CategoryId'].')"> Xóa </button>
                </td>
            </tr>';
}
?>

           
                    </tbody>
                </table>
			</div>
		</div>
    </div>

    <script type="text/javascript">
		function deleteCategories(CategoryId) {
			var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
			if(!option) {
				return;
			}

			console.log(CategoryId)
			//ajax - lenh post
			$.post('ajax.php', {
				'CategoryId': CategoryId,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>
</html>