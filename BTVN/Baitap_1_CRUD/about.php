<!-- about.php -->


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý</title>
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
<?php include('header.php'); ?>

<body>
    <div class="container">
        <h1>Xử lý ảnh</h1>
        <div class="row">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Chọn ảnh để tải lên:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Tải lên Ảnh" name="submit">
            </form>
        </div>
    </div>
</body>

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
<script src="./js/theme-settings.js"></script>
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


<?php include('footer.php'); ?>