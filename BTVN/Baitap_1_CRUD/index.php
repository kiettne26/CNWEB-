<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="theme-color" content="#ffffff" />
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
</head>

<body>

	<?php
	include 'header.php';
	?>
	<div class="container">
		<div class="card">
			<div class="card-header text-end pb-0">
				<h4 class="card-title mb-0"><button data-bs-toggle="modal" data-bs-target="#modalAddProduct" id="btn-add-catalog" class=" btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Thêm sản phẩm</button></h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-nowrap mb-0">
						<thead>
							<tr>
								<th>Sản phẩm</th>
								<th>Giá thành</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<?php include 'products.php'; ?>
						<tbody>
							<?php foreach ($products as $product): ?>
								<tr>
									<td><?= htmlspecialchars($product['name']) ?></td>
									<td><?= htmlspecialchars($product['price']) ?> VND</td>
									<td>
										<a href="#" data-id="<?= $product['id'] ?>" class="edit-product" data-bs-toggle="modal" data-bs-target="#modalEditProduct"><i class="fa-solid fa-pencil"></i></a>
									</td>
									<td>
										<a href="#" data-id="<?= $product['id'] ?>" class="delete-product" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct"><i class="fa-solid fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php' ?>
	<div id="modalAddProduct" class="modal fade" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-top pt-5" style="margin-top: 200px;">>
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="DetailLabel">Thêm sản phẩm</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<i class="fa-solid fa-close"></i>
					</button>
				</div>
				<div id="param-modal" class="modal-body">

					<form method="POST" class="formAdd">
						<input type="hidden" name="action" value="addProduct">
						<div class="row" style="margin-bottom: 5px;">
							<label class="col-form-label-default  col-md-4 text-end">Tên sản phẩm</label>
							<div class="col-md-8">
								<input name="name" type="text" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="row " style="margin-bottom: 5px;">
							<label class="col-form-label-default col-md-4 text-end">Giá thành</label>
							<div class="col-md-8">
								<input name="price" type="text" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="text-end">
							<button type="button" class="btn btn-outline-secondary2 btn-sm" data-bs-dismiss="modal">Hủy</button>
							<button type="submit" class="btn btn-primary btn-sm">Xác nhận</button>
						</div>
					</form>

				</div>
				<div class="modal-footer">




				</div>
			</div>
		</div>
	</div>
	<div id="modalEditProduct" class="modal fade" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-top pt-5" style="margin-top: 200px;">>
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="DetailLabel">Sửa sản phẩm</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<i class="fa-solid fa-close"></i>
					</button>
				</div>
				<div id="param-modal" class="modal-body">

					<form method="POST" class="formEdit">
						<input type="hidden" name="action" value="editProduct">
						<input type="hidden" name="id" id="editProductId">
						<div class="row" style="margin-bottom: 5px;">
							<label class="col-form-label-default col-md-4 text-end">Tên sản phẩm</label>
							<div class="col-md-8">
								<input name="name" id="editProductName" type="text" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="row" style="margin-bottom: 5px;">
							<label class="col-form-label-default col-md-4 text-end">Giá thành</label>
							<div class="col-md-8">
								<input name="price" id="editProductPrice" type="text" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="text-end">
							<button type="button" class="btn btn-outline-secondary2 btn-sm" data-bs-dismiss="modal">Hủy</button>
							<button type="submit" class="btn btn-primary btn-sm">Xác nhận</button>
						</div>
					</form>

				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<div id="modalDeleteProduct" class="modal fade" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-top pt-5" style="margin-top: 200px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="DetailLabel">Thông báo</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<i class="fa-solid fa-close"></i>
					</button>
				</div>
				<div id="param-modal" class="modal-body">
					<h5 class="">Bạn có chắc chắn muốn xóa không! </h5>
					<h6 class="text-danger"> Sản phẩm sẽ xóa sản phẩm vĩnh viễn</h6>
					<form method="POST" class="deleteform">
						<input type="hidden" name="action" value="deleteProduct">
						<input type="hidden" name="id" id="deleteProductId">

						<div class="text-end">
							<button id="btn-refresh" class="mx-1 btn btn-outline-secondary2 btn-sm" data-bs-dismiss="modal"> </i>Hủy</button>
							<button id="btn-send" type="submit" class="mx-1 btn btn-danger btn-sm"> Xác nhận</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
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
<script>
	document.querySelectorAll('.edit-product').forEach(button => {
		button.addEventListener('click', function() {
			const id = this.getAttribute('data-id');
			const row = this.closest('tr');
			const name = row.querySelector('td:nth-child(1)').innerText;
			const price = row.querySelector('td:nth-child(2)').innerText.split(' ')[0];

			document.getElementById('editProductId').value = id;
			document.getElementById('editProductName').value = name;
			document.getElementById('editProductPrice').value = price;
		});
	});
	document.querySelectorAll('.delete-product').forEach(button => {
		button.addEventListener('click', function() {
			const id = this.getAttribute('data-id');
			document.getElementById('deleteProductId').value = id;
		});
	});
</script>

</html>