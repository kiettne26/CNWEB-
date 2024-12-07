

#Kiểm tra kích thước tệp
<?php
if ($_FILES["fileToUpload"]["size"] > 500000) { // Ví dụ, giới hạn là 500 KB
echo "Xin lỗi, tệp tin của bạn quá lớn.";
exit;
}
#Kiểm tra kiểu tệp
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
// Chỉ cho phép một số định dạng tệp tin nhất định
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Xin lỗi, chỉ các tệp JPG, JPEG, PNG & GIF mới được cho phép.";
exit;
}
?>

#Di chuyển tệp tải lên (từ thư mục tạm tới thư mục đích trên Server)
<?php
$target_dir = "upload/img";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
echo "Tệp ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " đã được tải lên.";
} else {
echo "Xin lỗi, đã có lỗi xảy ra trong quá trình tải tệp tin của bạn.";
}
?>
<?php

