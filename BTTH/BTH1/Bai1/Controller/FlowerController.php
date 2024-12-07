<?php
require_once '../Model/FlowerModel.php';

class FlowerController {
    private $flowerModel;

    public function __construct() {
        $this->flowerModel = new FlowerModel();
    }

    public function index() {
        $flowers = $this->flowerModel->getAllFlowers();
        include '../views/admin.php';
    }

    public function admin() {
        $flowers = $this->flowerModel->getAllFlowers();
        include '../views/admin.php';
    }

    public function addFlower($data) {
        if (!empty($data['name']) && !empty($data['description']) && !empty($data['images'])) {
            $newFlower = [
                'name' => $data['name'],
                'description' => $data['description'],
                'images' => $data['images'], // Mảng đường dẫn hình ảnh
            ];
            $this->flowerModel->addFlower($newFlower);
            header('Location: ../views/admin.php');
        } else {
            echo "Vui lòng điền đầy đủ thông tin!";
        }
    }

    public function deleteFlower($id) {
        $this->flowerModel->deleteFlower($id);
        header('Location: ../views/admin.php');
    }

    public function updateFlower($id, $data) {
        if (!empty($data['name']) && !empty($data['description']) && !empty($data['images'])) {
            $updatedFlower = [
                'name' => $data['name'],
                'description' => $data['description'],
                'images' => $data['images'],
            ];
            $this->flowerModel->updateFlower($id, $updatedFlower);
            header('Location: ../views/admin.php');
        } else {
            echo "Vui lòng điền đầy đủ thông tin!";
        }
    }
}

$controller = new FlowerController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $controller->addFlower([
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'images' => explode(',', $_POST['images']),
                ]);
                break;

            case 'update':
                $controller->updateFlower($_POST['id'], [
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'images' => explode(',', $_POST['images']),
                ]);
                break;

            case 'delete':
                $controller->deleteFlower($_POST['id']);
                break;
        }
    }
} else {
    if (isset($_GET['page']) && $_GET['page'] === 'admin') {
        $controller->admin();
    } else {
        $controller->index();
    }
}
?>
