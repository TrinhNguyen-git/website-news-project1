<?php
// chucnang.php tổng họp chức năng của từng trang để dễ xử lý
class chucnanglib extends ketnoilib{
	
	function dangky(){
		$error = array();
		$data = array();
		
		//Lấy dữ liệu
		$data ['username'] = isset ( $_POST ['username'] ) ? $_POST ['username'] : ''; //kiểm tra username
		$data ['email'] = isset ( $_POST ['email'] ) ? $_POST ['email'] : ''; //kiểm tra email
		$data ['password'] = isset ( $_POST ['password'] ) ? $_POST ['password'] : ''; //kiểm tra mật khẩu
		
		//Kiểm tra dữ liệu
		//https://www.w3schools.com/php/func_var_empty.asp  hàm empty
		if (empty($data ['username'])) {
			$error['username'] = 'Bạn chưa nhập tên';
		}
		
		if (empty($data ['email'])) {
			$error['email'] = 'Bạn chưa nhập email';
		}
		
		//kiểm tra email
		//https://www.w3schools.com/php/func_filter_var.asp hàm filter_var
		if (!filter_var($data ['email'], FILTER_VALIDATE_EMAIL)) { 
			
			$error['email'] = 'Email không đúng định dạng';
		}
		
		if (empty($data ['password'])) {
			$error['password'] = 'Bạn chưa nhập password';
		}
		
		// Kiểm tra nếu không có lổi thì Lưu dữ liệu
		if (!$error) {
			
			// Mã hóa password bằng MD5 để bảo mật mật khẩu
			$data ['password'] = md5($data ['password']);
			// Thời gian khi user được tạo
			$data["createdate"] = date("Y-m-d H:i:s");
			
			// Gọi hàm insert từ class_db.php để insert dữ liệu
			$this->insert("user", $data);
			$data['password'] = $_POST["password"]; // khi insert dữ liệu trả về đúng pass trước khi bị mã hóa
			
			$error["note"] = "Đăng ký thành công!";
		}
		else {
			$error["note"] = "Đăng ký thất bại!";
		}
		
		// Trả về $error để thông báo lổi nếu có
		$message[0] = $error;
		$message[1] = $data;
		
		return $message;
	}
	
	// hàm đăng nhập
	function dangnhap(){
		$error = array();
		$data = array();
		
		// lấy dữ liệu
		$data ['username'] = isset ( $_POST ['username'] ) ? $_POST ['username'] : '';
		$data ['password'] = isset ( $_POST ['password'] ) ? $_POST ['password'] : '';
		
		// kiểm tra dữ liệu
		if (empty($data ['username'])) {
			$error['username'] = 'Bạn chưa nhập tên';
		}
		
		if (empty($data ['password'])) {
			$error['password'] = 'Bạn chưa nhập password';
		}
		
		// kiểm tra nếu không có lổi thì Lưu dữ liệu
		if (!$error) {
			
			$username = $data ['username'];
			// mã hóa password bằng MD5 để bảo mật mật khẩu
			$password = md5($data ['password']);
			
			// sql: hàm count(*) dùng để đếm tổng số dữ liệu được tìm thấy xem có trùng user không
			$sql = "SELECT count(*) FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
			
			// Gọi hàm get_row() từ class_db.php để lấy dữ liệu trả về cho biến $result
			$result = $this->layrow($sql);
			
			if ($result > 0) {
				// tạo thông báo
				$error['message'] = "Đăng nhập thành công!";
				
				// lưu thông tin user vào cookie để không đăng nhập lần nữa, cookie sẽ có thời hạn 24h
				// https://www.w3schools.com/php/func_network_setcookie.asp hàm setcookie
				setcookie("user", $username, time() + (86400 * 30));
				
			}
			else {
				// tạo thông báo
				$error['message'] = "username hoặc password không đúng!";
			}
		}
		
		// trả về $error để thông báo
		$message[0] = $error;
		$message[1] = $data;
		
		return $message;
	}
}
?>