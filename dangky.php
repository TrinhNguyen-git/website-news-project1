<?php
// dangky.php đăng ký tài khoản sử dụng website tin tức
// tạo hàm quản lý thư viện 
function thuvien(){
	include 'connect.php';
	include 'chucnang.php';
}
thuvien();

$chucnang = new chucnanglib();

// kiểm tra người dùng nhấn nút đăng ký
if (isset($_POST["dangky_action"])){
	$message = $chucnang->dangky();
	$error = $message[0];
	$data = $message[1];
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Đăng ký</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Đăng ký</h1>
		<form method="post" action="dangky.php" target ="_self">
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td>Tên của bạn</td>
				<td><input type="text" name="username" id="username"
					value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" />
                  <?php echo isset($error['username']) ? $error['username'] : ''; ?>
               </td>
			</tr>
			<tr>
				<td>Email của bạn</td>
				<td><input type="text" name="email" id="email"
					value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" />
                  <?php echo isset($error['email']) ? $error['email'] : ''; ?>
               </td>
			</tr>
			<tr>
				<td>Mật khẩu của bạn</td>
				<td><input type="text" name="password" id="password"
					value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" />
                  <?php echo isset($error['password']) ? $error['password'] : ''; ?>
               </td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="dangky_action" value="Đăng ký" /></td>
			</tr>
			
		</table>
		<?php
			echo isset($error['note']) ? $error['note'] : '';
		?>
	</form>
	</body>
</html>