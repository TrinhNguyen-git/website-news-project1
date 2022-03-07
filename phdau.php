<!-- phần cđầu của website tin tức -->
<?php
// tạo hàm quản lý thư viện 
function thuvien(){
	include 'connect.php';
	include 'chucnang.php';
}
thuvien();

$homelib = new chucnanglib();

$sql = "SELECT * FROM category";
$data = $homelib->get_list($sql);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Tin Tức Tổng Hợp</title>
		<link rel="stylesheet" href="style.css">
		<!-- Bootstrap core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/blog-home.css" rel="stylesheet">
	</head>
	<body>
		<!--<div class="container">-->
			<div class="dau">
				<h1><strong><a href="trangchu.php">Tin Tức Tổng Hợp</strong></h1>
				
			</div>
			<div class="menutop"><ul>
				<?php 
				for ($i = 0; $i < count($data); $i++) {
				?>
				<li class="nav-item">
				  <a class="nav-link" href="trangchu.php?cat=<?php echo $data[$i]["category_id"]; ?>"><?php echo $data[$i]["name"];?></a>
				</li>
					
				<?php 
				}
				?>
				<!--
				<li><a href="#">Trang Chủ</a></li>
				<li><a href="#">Sự Kiện</a></li>
				<li><a href="#">Ngôi Sao</a></li>
				<li><a href="#">Thế Giới</a></li>
				<li><a href="#">Thể Thao</a></li>
				-->
				
				<!-- nếu cookie có giá trị thì in ra user-->
				<?php if(isset($_COOKIE["user"])){ ?>
					<?php echo "<li><a href='#'>User</a></li>"; ?> <li><a href="dangxuat.php">Đăng xuất</a></li>
				<?php
				}
				else {
				?>
					<li><a href="dangnhap.php">Đăng Nhập</a></li><li><a href="dangky.php">Đăng Ký</a></li>
				<?php
				}
				?>
				
				<!-- thanh tìm kiếm -->
				<form action="?quanly=timkiem" method="post">
				<input type="text" placeholder="Nhập từ khóa..." name="tukhoa">
				<input type="submit" name="timkiem" value="Tìm">
				</form>
				</ul>
			</div>
			<br>
			<br>
			
	<!--	</div>-->
	</body>
</html>