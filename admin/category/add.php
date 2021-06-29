<?php
require_once ('../../database/dbhelper.php');
$CategoryId = $CategoryName ='';
if (!empty($_POST)){
    
    if (isset($_POST['CategoryId'])){
        $CategoryName = $_POST['CategoryName'];
        $CategoryName = str_replace('"', '\\"', $CategoryName);
    }
    if (isset($_POST['CategoryId'])){
        $CategoryId = $_POST['CategoryId'];
    }
    if (!empty($CategoryName)){

       if ($CategoryId == ''){
            $sql = 'insert into categories(CategoryName) values("'.$CategoryName.'")';
       } else {
            $sql = 'update categories set CategoryName = "'.$CategoryName.'" where CategoryId ='.$CategoryId ;
       }
        execute($sql);

        header('Location: index.php');
        die();
    }
}
if (isset($_GET['CategoryId'])) {
    $CategoryId       = $_GET['CategoryId'];

    $sql      = 'select * from categories where CategoryId = '.$CategoryId;

    $categories = executeSingleResult($sql);

	if ($categories != null) {
		$CategoryName = $categories['CategoryName'];
    }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Thể Loại</title>
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
            <a class="nav-link" href="index.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../product">Quản lý sản phẩm</a>
        </li>
        
    </ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Thể Loại</h2>
			</div>
			<div class="panel-body">
                <form method="POST">
                    <div class="form-group">
                    <label for="CategoryName">Tên Thể Loại:</label>
                        <input type="text" name="CategoryId" value="<?=$CategoryId?>" hidden="true">
                        <input required="true" type="text" class="form-control" id="CategoryName" name="CategoryName" value="<?=$CategoryName?>">
					</div>
                    </div>
                    <button class="btn btn-success">Lưu</button>
                
                </form>
			</div>
		</div>
	</div>
</body>
</html>