<?php
class adminlib extends ketnoilib {
		
	// Hàm lấy dropdown tất cả danh mục
	function get_dropdown_category($list, $value) {
		
		$info = '<option value="0">Chọn chuyên mục</option>';
		for ($i = 0; $i < count($list); $i++) {
			
			$selected = $list[$i]["category_id"] == $value ? 'selected' : '';
			
			$info .= '<option value="'.$list[$i]["category_id"].'" '.$selected.' >'.$list[$i]["name"].'</option>';
		}
		
		return $info;
	}
	
	// Add post
	function them_post() {
		$error = array ();
		$data = array ();
		
		// Lấy dữ liệu
		$data['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$data['content'] = isset($_POST['content']) ? $_POST['content'] : '';
		$data['category_id'] = isset($_POST['category_id']) && $_POST['category_id'] != 0 ? $_POST['category_id'] : '';
		
		// Kiểm tra dữ liệu
		if (empty($data['title'])) {
			$error['title'] = 'Bạn chưa nhập tiêu đề';
		}
		
		if (empty($data['content'])) {
			$error['content'] = 'Bạn chưa nhập nội dung';
		}
		
		if (empty($data['category_id'])) {
			$error['category_id'] = 'Bạn chưa chọn chuyên mục';
		}
		
		// Code PHP upload file
		$target_dir = "../image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		
		// Kiểm tra file có phải là hình hay giả mạo
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		}
		else {
			$error["image"] = "File không phải là hình.";
			$uploadOk = 0;
		}
		// Kiểm tra file đã tồn chưa
		if (file_exists($target_file)) {
			$error["image"] = "Lổi, file đã tồn tại trên thư mục images rồi";
			$uploadOk = 0;
		}
		// kiểm tra kích thước file khi upload lên
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$error["image"] = "Lổi, kích thước file quá lớn";
			$uploadOk = 0;
		}
		// Kiểm tra phần mở rộng của file
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			$error["image"] = "Lổi, chỉ cho phép file có phần mở rộng là JPG, JPEG, PNG & GIF.";
			$uploadOk = 0;
		}
		
		// Kiểm tra nếu $uploadOk là 0 có nghĩa đã có lổi và không upload được
		if ($uploadOk != 0) {
			if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$error["image"] = "Xin lổi, đã xảy ra lổi trong khi upload file.";
			}
			else {
				$data['image'] = basename($_FILES["fileToUpload"]["name"]);
			}
		}
		
		// nếu ok hết thì insert dữ liệu vào bảng posts
		if (!$error) {
			$data["createdate"] = date("Y-m-d H:i:s"); // bài post đuọc tạo lúc nào
			$this->insert("posts", $data);
			$error["note"] = "Thêm bài viết thành công";
			header('Location:dangtin.php');
			die();
		}
		else {
			$error["note"] = "Thêm bài viết thất bại";
		}
		
		// Trả về $error để thông báo lổi nếu có
		$message[0] = $error;
		$message[1] = $data;
		
		return $message;
	}
	
	
	// Hàm update posts
	function sua_post($post_id) {
		$error = array ();
		$data = array ();
		
		// Lấy dữ liệu
		$data['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$data['content'] = isset($_POST['content']) ? $_POST['content'] : '';
		$data['category_id'] = isset($_POST['category_id']) && $_POST['category_id'] != 0 ? $_POST['category_id'] : '';
		
		// Kiểm tra dữ liệu
		if (empty($data['title'])) {
			$error['title'] = 'Bạn chưa nhập tiêu đề';
		}
		
		if (empty($data['content'])) {
			$error['content'] = 'Bạn chưa nhập nội dung';
		}
		
		if (empty($data['category_id'])) {
			$error['category_id'] = 'Bạn chưa chọn chuyên mục';
		}
		
		// chỉ cập nhật ảnh khi thêm ảnh mới
		if ($_FILES["fileToUpload"]["tmp_name"] != '') {
			// Code PHP upload file
			$target_dir = "../image/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			
			// Kiểm tra file có phải là hình hay giả mạo
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check !== false) {
				$uploadOk = 1;
			}
			else {
				$error["image"] = "File không phải là hình.";
				$uploadOk = 0;
			}
			
			// kiểm tra kích thước file khi upload lên
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$error["image"] = "Lổi, kích thước file quá lớn";
				$uploadOk = 0;
			}
			// Kiểm tra phần mở rộng của file
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$error["image"] = "Lổi, chỉ cho phép file có phần mở rộng là JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}
			
			// Kiểm tra nếu $uploadOk là 0 có nghĩa đã có lổi và không upload được
			if ($uploadOk != 0) {
				if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$error["image"] = "Xin lổi, đã xảy ra lổi trong khi upload file.";
				}
				else {
					$data['image'] = basename($_FILES["fileToUpload"]["name"]);
				}
			}
		}
		
		// nếu ok hết thì insert dữ liệu vào bảng posts
		if (!$error) {
			
			$this->sua("posts", $data, "post_id = $post_id");
			$error["note"] = "Cập nhật bài viết thành công!";
		}
		else {
			$error["note"] = "Cập nhật bài viết thất bại!";
		}
		
		// Trả về $error để thông báo lổi nếu có
		$message[0] = $error;
		$message[1] = $data;
		
		return $message;
	}
	
	function xoa_post($post_id) {
		
		// xóa ảnh trên website dựa vào post_id
		$sql = "SELECT image FROM posts WHERE post_id = $post_id";
		$link = $this->layrow($sql);
		unlink('../image/'.$link['image']); // hàm xóa file trên website : https://www.w3schools.com/php/func_filesystem_unlink.asp
		
		// xóa bài đăng
		$this->xoa("posts", "post_id = $post_id");
		header('Location:dangtin.php');
		die();
	}
	
	// Hàm Đăng nhập
	function dangnhap() {
		$error = array ();
		$data = array ();
		
		// Lấy dữ liệu
		$data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
		$data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
		
		// Kiểm tra dữ liệu
		if (empty($data['username'])) {
			$error['username'] = 'Bạn chưa nhập tên';
		}
		
		if (empty($data['password'])) {
			$error['password'] = 'Bạn chưa nhập password';
		}
		
		// Kiểm tra nếu không có lổi thì Lưu dữ liệu
		if (! $error) {
			
			$username = $data['username'];
			// Mã hóa password bằng MD5 để bảo mật mật khẩu
			$password = md5($data['password']);
			
			// SQL: hàm count(*) dùng để đếm tổng số dữ liệu được tìm thấy
			$sql = "SELECT count(*) FROM user WHERE username = '$username' AND password = '$password' AND permission = 1 LIMIT 1";
			
			// Gọi hàm get_row_number() từ class_db.php để lấy dữ liệu trả về cho biến $result
			$result = $this->get_row_number($sql);
			
			if ($result > 0) {
				// Tạo thông báo
				$error['message'] = "Đăng nhập thành công";
				
				// Lưu thông tin admin vào cookie để không đăng nhập lần nữa, cookie sẽ có thời hạn 24h
				setcookie("admin", $username, time() + (86400 * 30));
				header("Location:index.php");
				die();
			}
			else {
				// Tạo thông báo
				$error['message'] = "username hoặc password không đúng!";
			}
		}
		
		// Trả về $error để thông báo
		$message[0] = $error;
		$message[1] = $data;
		
		return $message;
	}
}

?>