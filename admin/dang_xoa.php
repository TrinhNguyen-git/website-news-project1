<?php
// tạo hàm quản lý thư viện 
function thuvien(){
	include '../connect.php';
	include '../adchucnang.php';
}
thuvien();

$adminlib = new adminlib();

// https://www.w3schools.com/php/func_var_intval.asp hàm intval
$post_id = intval($_GET["id"]);
if (isset($_POST["xoa_action"])) {
	$adminlib->xoa_post($post_id);
}

?>
<?php include 'adphandau.php';?>
<?php include 'adsidebar.php';?>
<script src="ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h2>Xóa bài viết</h2>
			</div>
		</div>
		<hr />

<form action="dang_xoa.php?id=<?php echo $post_id ?>" method="post">
Bạn chắc chắn muốn xóa?<br>
<input type="submit" name="xoa_action" value="Xóa bài viết" class="btn btn-success">
</form>


	</div>
</div>
</div>
<?php include 'adphancuoi.php';?>