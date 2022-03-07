<?php
// tạo hàm quản lý thư viện 
function thuvien(){
	include '../connect.php';
	include '../adchucnang.php';
}
thuvien();

$adminlib = new adminlib();

// thuật toán phân trang
$sql = "SELECT count(*) FROM posts";
$total_records = $adminlib->laysodong($sql);

$limit = 3;

$tranghh = isset($_GET['trang']) ? $_GET['trang'] : 1; // $tranghh cho biết hiện tại đang ở trang số mấy

$trangtb = ceil($total_records / $limit); // hàm làm tròn // $trangtn là tổng số trang

if ($tranghh > $trangtb){
	$tranghh = $trangtb;
}
else if ($tranghh < 1) {
	$tranghh = 1;
}

$start = ($tranghh - 1) * $limit;

// lấy id chuyên mục để show đồng thời dùng limit để thực hiện phân trang
$sql = "SELECT * FROM posts a JOIN category b on a.category_id = b.category_id ORDER BY createdate DESC LIMIT $start, $limit";

$data = $adminlib->get_list($sql);
?>

<?php include 'adphandau.php';?>
        <?php include 'adsidebar.php';?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>QUẢN LÝ BÀI VIẾT</h2>   
                    </div>
                </div>              
                 <!-- /. cột -->
                <hr />
                <a href="themtin.php"><input type="buton" class="btn btn-success" value="Thêm Bài Viết"></a><br><br>
                
				<!-- show bài viết vào bảng để dễ xử lý -->
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Hình ảnh</th>
							<th>Tiêu đề</th>
							<th>Chuyên mục</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
					<?php
					for($i = 0; $data != 0 && $i < count($data); $i ++) {
						$id = $data[$i]["post_id"];
						?>
						<tr>
							<td><img src="../image/<?php echo $data[$i]["image"];?>" width="50px" height="50px"></td>
							<td><?php echo $data[$i]["title"];?></td>
							<td><?php echo $data[$i]["name"];?></td>
							<td><a href="dang_sua.php?id=<?php echo $id;?>">sửa</a> | <a href="dang_xoa.php?id=<?php echo $id;?>">xóa</a></td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
				<ul class="pagination">
                <?php 
                if ($tranghh > 1 && $trangtb > 1){
                	echo '<li><a href="dangtin.php?trang='.($tranghh-1).'">Trước</a></li>';
                }
                
                for ($i = 1; $i <= $trangtb; $i++) {
                	
                	if ($tranghh == $i)
                		echo '<li class="disabled"><a href="#">'.$i.'</a></li>';
                	else
                		echo '<li><a href="dangtin.php?trang='.$i.'">'.$i.'</a></li>';
                }
                
                if ($tranghh < $trangtb && $trangtb > 1){
                	echo '<li><a href="dangtin.php?trang='.($tranghh+1).'">Sau</a></li>';
                }
                
                ?>
                </ul>
                
    		</div>

            </div>

        </div>
 