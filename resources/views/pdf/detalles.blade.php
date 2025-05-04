<!-- filepath: c:\xampp\htdocs\proyectoSI2\resources\views\pdf\detalles.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Detalles</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Detalles de Ventas y Compras</h1>
    <h2>Detalles de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Venta</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallesVentas as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>{{ $detalle->id_venta }}</td>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio_unitario }}</td>
                    <td>{{ $detalle->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Detalles de Compras</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Compra</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallesCompras as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>{{ $detalle->id_compra }}</td>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio_unitario }}</td>
                    <td>{{ $detalle->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
