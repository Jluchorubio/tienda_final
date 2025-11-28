include __DIR__ . "/../config/conexion.php";

$factura_id = $_POST['factura_id'];
$producto_id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];

// Obtener precio del producto
$producto = $conexion->query("SELECT precio FROM productos WHERE id = $producto_id")->fetch(PDO::FETCH_ASSOC);
$precio = $producto['precio'];

$subtotal = $cantidad * $precio;

// Guardar detalle
$conexion->query("
    INSERT INTO detalle_factura (factura_id, producto_id, cantidad, precio, subtotal)
    VALUES ($factura_id, $producto_id, $cantidad, $precio, $subtotal)
");

// Recalcular total
$conexion->query("
    UPDATE factura
    SET total = (SELECT SUM(subtotal) FROM detalle_factura WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");

header("Location: list.php?factura_id=$factura_id");
exit();
