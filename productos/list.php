<?php
include __DIR__ . '/../config/conexion.php';

// =========================
// Cargar categorías (para filtro)
// =========================
$stmtCat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// categoría seleccionada en el filtro
$categoria_filtro = $_GET['categoria'] ?? '';

// =========================
// Consultar productos (con o sin filtro)
// =========================
if ($categoria_filtro) {
    $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            WHERE p.categoria_id = :cat
            ORDER BY p.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cat' => $categoria_filtro]);
} else {
    $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            ORDER BY p.id DESC";

    $stmt = $pdo->query($sql);
}