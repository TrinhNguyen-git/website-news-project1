<?php
// connect.php dùng để kết nối với mysql bằng bdo
class ketnoilib{
	
	// tạo biến lưu trữ kết nối
	private $__conn;
	
	// hàm kết nối với csdl
	function connect()
	{
		// thông tin database
		$servername = "localhost";
		$username = "root"; // tài khoản của phpmyadmin
		$password = "";
		$dbname = "websitetintuc";// tên của database
		
		// kiểm tra kết nối chưa, nếu chưa thì thực hiện kết nối
		if (!$this->__conn){
			// kết nối			
			try {
				$this->__conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$this->__conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // https://www.php.net/manual/en/pdo.setattribute.php
			}
			catch(PDOException $e){ // https://www.w3schools.com/php/php_exceptions.asp
				echo "Error: " . $e->getMessage(); // https://www.w3schools.com/php/ref_exception_getmessage.asp hàm getMessage
				die();
			}
		}
	}
	
	// hàm hủy kết nối
	function dis_connect(){
		// nếu đang kết nối thì hủy
		if ($this->__conn){
			$this->__conn = null;
		}
	}
	
	//hàm insert
	function insert($table, $data)
	{
		// kết nối
		$this->connect();
		
		// lưu trữ dữ liệu
		$field_list = '';
		// lưu trữ danh sách dữ liệu tương ứng với field
		$value_list = '';
		
		// lập qua dữ liệu
		foreach ($data as $key => $value){ // https://www.w3schools.com/php/php_looping_foreach.asp vòng lặp foreach
			$field_list .= ",$key";
			$value_list .= ",'".$value."'";
		}
		
		// vì sau vòng lặp biến $filed_list và $value_list se thừa một dấu nên dùm hàm trim để xóa nó
		$sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		
		return $stmt->execute();
	}
	
	// Hàm sửa
	function sua($table, $data, $where)
	{
		// kết nối
		$this->connect();
		$sql = '';
		// lập qua dữ liệu
		foreach ($data as $key => $value){
			$sql .= "$key = '".$value."',";
		}
		
		//  vì sau vòng lặp biến $sql sẽ thừa một dấu nên dùm hàm trim để xóa nó
		$sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		
		return $stmt->execute();
	}
	
	// hàm xóa
	function xoa($table, $where){
		// kết nối
		$this->connect();
		
		// xóa
		$sql = "DELETE FROM $table WHERE $where";
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		
		return $stmt->execute();
	}
	
	// hàm lấy danh sách
	function get_list($sql)
	{
		// kết nối
		$this->connect();
		
		// thực hiện lấy dữ liệu
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC); // dữ liệu trả về sẽ chuyển sang dạng array
			
		return $stmt->fetchALL();	
	}
	
	// hàm lấy một record duy nhất
	function layrow($sql)
	{
		// kết nối
		$this->connect();
		
		// thực hiện lấy dữ liệu
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC); // dữ liệu trả về sẽ chuyển sang dạng array
		
		return $stmt->fetch();	// https://www.w3schools.com/js/js_api_fetch.asp hàm fetch
	}
	
	// hàm lấy số dòng
	function laysodong($sql)
	{
		// Kết nối
		$this->connect();
		
		// Thực hiện lấy dữ liệu
		$stmt = $this->__conn->prepare($sql); // https://www.w3schools.com/php/func_mysqli_prepare.asp hàm prepare
		$stmt->execute();
		
		return $stmt->fetchColumn(); // https://www.php.net/manual/en/pdostatement.fetchcolumn.php hàm fetchColumn 
	}
}
?>