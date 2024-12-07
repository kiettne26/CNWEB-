<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="theme-color" content="#ffffff" />
	<title>Câu hỏi Ôn tập</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" href="./plugins/fontawesome/css/fontawesome.min.css" />
	<link rel="stylesheet" href="./plugins/fontawesome/css/all.min.css" />
	<link rel="stylesheet" href="./plugins/alertify/alertify.min.css" />
	<link rel="stylesheet" href="./css/line-awesome.min.css" />
	<link rel="stylesheet" href="./css/material.css" />
	<link rel="stylesheet" href="./css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" href="./plugins/toastr/toatr.css" />
	<link rel="stylesheet" href="./css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="./plugins/select2/css/select2.min.css" />
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" href="./css/report.css" />
	<link rel="stylesheet" href="./css/cropper.min.css" />
	<link rel="stylesheet" href="./css/custom-sidebar.css" />
	<link rel="stylesheet" href="./css/custom.style.css" />
</head>

<body>
	<?php
	require 'dbconnect.php';
	?>
	<?php
	include 'header.php';
	?>

	<div class="container">
		<h1 class="text-center fw-bold my-2">Thông Tin Sinh Viên</h1>
		<div class="text-end">
			<form method="POST" action="">
				<button type="submit" name="save" class="btn btn-primary my-2">Lưu vào CSDL</button>
			</form>

		</div>
		<?php

		$filename = "./sinhvien.csv";
		$status = true;  

		$sinhvien = [];

		if (file_exists($filename) && ($handle = fopen($filename, "r")) !== FALSE) {

			$bom = fread($handle, 3);
			if ($bom == "\xEF\xBB\xBF") {
				// Nếu có BOM, bỏ qua 3 byte BOM
				$headers = fgetcsv($handle, 1000, ",");
			} else {

				rewind($handle);
				$headers = fgetcsv($handle, 1000, ",");
			}

			// Kiểm tra nếu có dữ liệu tiêu đề
			if ($headers !== FALSE) {

				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

					// Nếu dữ liệu không đầy đủ, bỏ qua dòng đó
					if (count($data) === count($headers)) {
						$sinhvien[] = array_combine($headers, $data);
					}
				}
			}

			if (isset($_POST['save'])) {
				// Lặp qua mảng sinh viên và chèn từng dòng vào cơ sở dữ liệu
				foreach ($sinhvien as $sv) {

					$username = $sv['username'];
					$password = $sv['password'];
					$lastname = $sv['lastname'];
					$firstname = $sv['firstname'];
					$city = $sv['city'];
					$email = $sv['email'];
					$course1 = $sv['course1'];

					// Thực thi câu lệnh SQL để chèn dữ liệu vào bảng
					$sql = "INSERT INTO sinhvien (username, password, lastname, firstname, city, email, course1) 
                    VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";
					
				

					if ($conn->query($sql) === TRUE) {
						$status=true;
					} else {
						echo "Lỗi: " . $sql . "<br>" . $conn->error . "<br>";
						$status=false;
					}
				}
				if($status==true)
				echo "<h6 class=\"text-center text-success fw-bold \">Dữ liệu đã được lưu thành công!</h6><br>";


				
			}

		} else {
			echo "<div class='alert alert-danger' role='alert'>Không thể mở tệp CSV hoặc tệp không tồn tại.</div>";
		}



		?>

		<table class="table table-bordered table-striped">
			<thead class="table">
				<tr>
					<th>Username</th>
					<th>Password</th>
					<th>Họ</th>
					<th>Tên</th>
					<th>Thành phố</th>
					<th>Email</th>
					<th>Khóa học</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Hiển thị dữ liệu sinh viên từ mảng
				if (!empty($sinhvien)) {
					foreach ($sinhvien as $sv) {
						// Kiểm tra tồn tại của các trường trước khi hiển thị
						$username = isset($sv['username']) ? $sv['username'] : 'N/A';
						$password = isset($sv['password']) ? $sv['password'] : 'N/A';
						$lastname = isset($sv['lastname']) ? $sv['lastname'] : 'N/A';
						$firstname = isset($sv['firstname']) ? $sv['firstname'] : 'N/A';
						$city = isset($sv['city']) ? $sv['city'] : 'N/A';
						$email = isset($sv['email']) ? $sv['email'] : 'N/A';
						$course1 = isset($sv['course1']) ? $sv['course1'] : 'N/A';

						echo "<tr>";
						echo "<td>{$username}</td>";
						echo "<td>{$password}</td>";
						echo "<td>{$lastname}</td>";
						echo "<td>{$firstname}</td>";
						echo "<td>{$city}</td>";
						echo "<td>{$email}</td>";
						echo "<td>{$course1}</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu để hiển thị</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>




</body>
<?php
include 'footer.php';
?>
<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/jquery.mask.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/jquery.slimscroll.min.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap4.min.js"></script>
<script src="./js/dataTables.fixedColumns.js"></script>
<script src="./js/fixedColumns.dataTables.js"></script>
<script src="./plugins/toastr/toastr.min.js"></script>
<script src="./plugins/toastr/toastr.js"></script>
<script src="./plugins/alertify/alertify.min.js"></script>
<script src="./js/layout.js"></script>
<script src="./js/const.js"></script>
<script src="./js/toast.js"></script>
<script src="./js/config.js"></script>
<script src="./js/report.js"></script>
<script src="./js/notification.js"></script>
<script src="./js/date-util.js"></script>
<script src="./js/moment.min.js"></script>
<script src="./js/moment-vi.js"></script>
<script src="./js/bootstrap-datetimepicker.min.js"></script>
<script src="./js/datetime-moment.js"></script>
<script src="./plugins/select2/js/select2.min.js"></script>
<script src="./js/uc-helpers.js"></script>
<script src="./js/ucform-helpers.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/cropper.js"></script>
<script src="./js/uuid.js"></script>
<script src="./js/JsBarcode.all.min.js"></script>
<script src="./js/lodash.min.js"></script>

</html>