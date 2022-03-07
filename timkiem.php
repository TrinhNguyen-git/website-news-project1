<?php
// tạo hàm quản lý thư viện 
function thuvien(){
	include 'connect.php';
	include 'chucnang.php';
	include 'phdau.php';
}
thuvien();

if (isset($_POST['timkiem'])) {
	$tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM posts,category WHERE posts.category_id=category.category_id AND posts.title LIKE '%" . $tukhoa . "%'";
$query_pro = mysqli_query($mysqli, $sql_pro);

?>
<h3>Từ khoá tìm kiếm : <?php echo $_POST['tukhoa']; ?></h3>
<div class="col-md-8">
    <?php
	while ($row = mysqli_fetch_array($query_pro)) {
	?>
	      <div class="card mb-4">
	        <img class="card-img-top" src="image/<?php echo $row['image'];?>" height="300px" alt="Card image cap">
	        <div class="card-body">
	          <h2 class="card-title"><?php echo $row['title'];?></h2>
	          <p class="card-text"><?php echo substr($row['content'], 0, 200).'...';?></p>
	        </div>
	      </div>
	  <?php	
		}
	  ?>
</div>