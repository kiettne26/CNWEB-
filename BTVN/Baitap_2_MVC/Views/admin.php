<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php
require_once '../Model/FlowerModel.php';

$flowerModel = new FlowerModel();
$flowers = $flowerModel->getAllFlowers();
?>


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#ffffff" />
    <title>Trang báo về hoa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../plugins/alertify/alertify.min.css" />
    <link rel="stylesheet" href="../css/line-awesome.min.css" />
    <link rel="stylesheet" href="../css/material.css" />
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../plugins/toastr/toatr.css" />
    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/report.css" />
    <link rel="stylesheet" href="../css/cropper.min.css" />
    <link rel="stylesheet" href="../css/custom-sidebar.css" />
    <link rel="stylesheet" href="../css/custom.style.css" />
</head>
<style>
    td {
        word-wrap: break-word;
        /* Cho phép từ bị ngắt xuống dòng */
        white-space: pre-wrap;
        /* Giữ nguyên các khoảng trắng và xuống dòng trong nội dung */
    }
</style>

<body>
    <?php
    include 'header.php';
    ?>

    <!-- Form Thêm Hoa -->

    <div class="px-5" style="width: 100%;">
        <div class="card">
            <div class="card-header text-end pb-0">
                <h4 class="card-title mb-0"><button data-bs-toggle="modal" data-bs-target="#modalAddFlower" id="btn-add-catalog" class=" btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Thêm bản ghi</button></h4>

            </div>
            <div class="card-body">
                <h3 class="mb-3 fw-bold">Danh sách bản ghi</h3>
                <div class="table">
                    <table class="table  mb-0">
                        <thead>
                            <tr>
                                <th style="width: 10%;">ID</th>
                                <th style="width: 20%;">Tên Hoa</th>
                                <th style="width: 40%;">Mô Tả</th>
                                <th style="width: 20%;">Hình Ảnh</th>
                                <th style="width: 10%;">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($flowers as $flower): ?>
                                <tr>
                                    <td style="width: 10%;"><?= htmlspecialchars($flower['id']) ?></td>
                                    <td style="width: 20%;"><?= htmlspecialchars($flower['name']) ?></td>
                                    <td style="width: 40%; white-space: break-spaces"><?= htmlspecialchars($flower['description']) ?></td>
                                    <td style="width: 20%;">
                                        <?php
                                        $images = explode(',', $flower['images']);
                                        foreach ($images as $image): ?>
                                            <img src="<?= htmlspecialchars($image) ?>" alt="Flower" style="width: 100px; height: 100px;">
                                        <?php endforeach; ?>
                                    </td>
                                    <td style="width: 10%;">
                                        <!-- Sửa -->
                                        <a class="edit-flower btn btn-secondary btn-sm text-white" href="#"
                                            
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditFlower"
                                            data-id="<?= htmlspecialchars($flower['id']) ?>"
                                            data-name="<?= htmlspecialchars($flower['name']) ?>"
                                            data-description="<?= htmlspecialchars($flower['description']) ?>"
                                            data-images="<?= htmlspecialchars($flower['images']) ?>">
                                            Sửa
                                        </a>
                                        <!-- Xóa -->
                                        <form method="POST" action="../Controller/FlowerController.php" style="display:inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $flower['id'] ?>">
                                            <button class="btn btn-warning btn-sm" type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalAddFlower" class="modal fade" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog  pt-5"  style=" margin-top: 200px;">>
            <div class="modal-content"  style="width: 1000px; margin-left: -300px;">
                <div class="modal-header">
                    <h4 class="modal-title" id="DetailLabel">Thêm bản ghi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div id="param-modal" class="modal-body">

                    <form method="POST" action="../Controller/FlowerController.php">
                        <input type="hidden" name="action" value="add">
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Tên Hoa</label>
                            <div class="col-md-10">
                                <input name="name" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Mô Tả:</label>
                            <div class="col-md-10">
                                <input name="description" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Đường dẫn ảnh</label>
                            <div class="col-md-10">
                                <input name="images" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class=" btn btn-primary btn-sm" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Flower -->
    <div class="modal fade" id="modalEditFlower" tabindex="-1" aria-labelledby="modalEditFlowerLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 200px;">
            <div class="modal-content" style="width: 1000px; margin-left: -300px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditFlowerLabel">Sửa Bản ghi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../Controller/FlowerController.php">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id"> <!-- ID ẩn -->
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Tên Hoa</label>
                            <div class="col-md-10">
                                <input name="name" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Mô Tả:</label>
                            <div class="col-md-10">
                                <input name="description" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <label class="col-form-label-default  col-md-2 text-end">Đường dẫn ảnh</label>
                            <div class="col-md-10">
                                <input name="images" type="text" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class=" btn btn-primary btn-sm" type="submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>


<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/jquery.mask.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.slimscroll.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script src="../js/dataTables.fixedColumns.js"></script>
<script src="../js/fixedColumns.dataTables.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script src="../plugins/toastr/toastr.js"></script>
<script src="../plugins/alertify/alertify.min.js"></script>
<script src="../js/layout.js"></script>
<script src="../js/const.js"></script>
<script src="../js/toast.js"></script>
<script src="../js/config.js"></script>
<script src="../js/report.js"></script>
<script src="../js/notification.js"></script>
<script src="../js/date-util.js"></script>
<script src="../js/moment.min.js"></script>
<script src="../js/moment-vi.js"></script>
<script src="../js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/datetime-moment.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/uc-helpers.js"></script>
<script src="../js/ucform-helpers.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/cropper.js"></script>
<script src="../js/uuid.js"></script>
<script src="../js/JsBarcode.all.min.js"></script>
<script src="../js/lodash.min.js"></script>
<script>
    // Lắng nghe sự kiện khi nhấn nút sửa
    $(document).on('click', '.edit-flower', function() {
        // Lấy giá trị từ data-* attributes
        const id = $(this).data('id');
        const name = $(this).data('name');
        const description = $(this).data('description');
        const images = $(this).data('images');

        // Tìm modal và điền dữ liệu vào các trường
        const modal = $('#modalEditFlower');
        modal.find('input[name="id"]').val(id); // Nếu cần ID ẩn
        modal.find('input[name="name"]').val(name);
        modal.find('input[name="description"]').val(description);
        modal.find('input[name="images"]').val(images);

        // Hiển thị modal nếu cần (trường hợp nút không tự mở)
        modal.modal('show');
    });
</script>


</html>