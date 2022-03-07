<?php
$link = '';
$where = '';
if (isset($_GET["cat"])) {
	$cat = intval($_GET["cat"]);
	if ($cat != 0)
		$where = "WHERE category_id = $cat";
	$link = "cat=$cat&";
}

$sql = "SELECT count(*) FROM posts $where";
$total_records = $homelib->laysodong($sql);

$limit = 3;

$tranghh = isset($_GET['page']) ? $_GET['page'] : 1;

$trangtb = ceil($total_records / $limit);

if ($tranghh > $trangtb){
	$tranghh = $trangtb;
}
else if ($tranghh < 1) {
	$tranghh = 1;
}

$start = ($tranghh - 1) * $limit;

$sql = "SELECT * FROM posts $where ORDER BY createdate DESC LIMIT $start, $limit";
$data = $homelib->get_list($sql);

?>

<!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="myDiv"><strong>Tin mới nhất</strong></small>
          </h1>
          
          <?php 
			for ($i = 0; $i < count($data); $i++) {
			?>
	          <div class="card mb-4">
	            <img class="card-img-top" src="image/<?php echo $data[$i]['image'];?>" height="300px" alt="Card image cap">
	            <div class="card-body">
	              <h2 class="card-title"><?php echo $data[$i]['title'];?></h2>
	              <p class="card-text"><?php echo substr($data[$i]['content'], 0, 200).'...';?></p>
	              <!--<a href="#" class="btn btn-primary">Xem thêm &rarr;</a>-->
	            </div>
	          </div>
		  <?php	
			}
		  ?>


          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
                <?php 
                if ($tranghh > 1 && $trangtb > 1){
                	echo '<li class="page-item"><a class="page-link" href="trangchu.php?'.$link.'page='.($tranghh-1).'">Trước</a></li>';
                }
                
                for ($i = 1; $i <= $trangtb; $i++) {
                	
                	if ($tranghh == $i)
                		echo '<li class="page-item disabled"><a class="page-link" href="#">'.$i.'</a></li>';
                	else
                		echo '<li class="page-item"><a class="page-link" href="trangchu.php?'.$link.'page='.$i.'">'.$i.'</a></li>';
                }
                
                if ($tranghh < $trangtb && $trangtb > 1){
                	echo '<li class="page-item"><a class="page-link" href="trangchu.php?'.$link.'page='.($tranghh+1).'">Sau</a></li>';
                }
                
                ?>
           </ul>

        </div>