<?php
require_once '../db.php'; // Đưa tệp kết nối vào

class FlowerModel {
    public function getAllFlowers() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM flowers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFlower($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM flowers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addFlower($flower) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO flowers (name, description, images) VALUES (?, ?, ?)");
        $stmt->execute([$flower['name'], $flower['description'], implode(',', $flower['images'])]);
    }

    public function deleteFlower($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM flowers WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function updateFlower($id, $updatedFlower) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE flowers SET name = ?, description = ?, images = ? WHERE id = ?");
        $stmt->execute([$updatedFlower['name'], $updatedFlower['description'], implode(',', $updatedFlower['images']), $id]);
    }
}
?>
