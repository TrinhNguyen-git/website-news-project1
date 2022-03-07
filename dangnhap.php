<?php
	function thuvien(){
	include 'connect.php';
	include 'chucnang.php';
}
thuvien();

$chucnang = new chucnanglib();
// kiểm tra người dùng nhấn nút đăng nhập
if (isset($_POST["dangnhap_action"])){
	$message = $chucnang->dangnhap();
	$error = $message[0];
	$data = $message[1];
	header('location:trangchu.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Đăng Nhập</title>
<meta charset="UTF-8">
</head>
<body>
	<h1>Đăng Nhập</h1>
	<form method="post" action="dangnhap.php">
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td>Tên của bạn</td>
				<td><input type="text" name="username" id="username"
					value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" />
                  <?php echo isset($error['username']) ? $error['username'] : ''; ?>
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
				<td><input type="submit" name="dangnhap_action" value="Đăng nhập" /></td>
			</tr>
		</table>
		<?php echo isset($error['message']) ? $error['message'] : ''; ?>
	</form>
</body>
</html>