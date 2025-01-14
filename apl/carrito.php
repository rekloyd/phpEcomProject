<?php
session_start();
date_default_timezone_set('Europe/Madrid');

$usuario = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$tipoUsuario = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : NULL;
$cart_empty = !(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - AliMorillas</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo">
            <h1>AliMorillas</h1>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="ayuda.php">Ayuda</a></li>
                <li><a href="carrito.php" style="text-decoration: underline;">Carrito</a></li>
                <?php
                if ($usuario) {
                    echo "<li style=\"color:blue; font-weight:bold;\"><a href='areasPersonales.php?tipo=" . $tipoUsuario . "' style='color:inherit;'>Hola, " . strtoupper(htmlspecialchars($usuario)) . "</a></li>";
                    echo "<li><a href='logout.php' class='log-in'>Cerrar sesión</a></li>";
                } else {
                    echo "<li><a href='login.html' class='log-in'>Log In</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <div class="banner">
            <h2>Tu Carrito</h2>
            <p>Revisa los productos que has añadido antes de completar tu compra.</p>
        </div>
        <section class="cart-container">
            <div class="cart-items">
                <h2>Productos en tu carrito</h2>
                <?php
                $subtotal = 0;

                if (!isset($_SESSION['username'])) {
                    echo "<p><b>Debe iniciar sesión antes.</b></p>";
                } else {
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $index => $product) {
                            $subtotal += ($product['price'] * $product['quantity']) * 1.21;
                            echo "<div class='cart-item'>";
                            echo "<div class='cart-item-left'>";
                            echo "<div class='cart-item-details'>";
                            echo "<h3>{$product['name']}</h3>";
                            echo "<p class='price'>€{$product['price']}</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='cart-item-right'>";
                            echo "<p>Cantidad: <span class='quantity-selector'>{$product['quantity']}</span></p>"; // Mostrar la cantidad sin poder modificarla
                            echo "<form method='POST' action='eliminarDeCarrito.php' style='display:inline;'>";
                            echo "<input type='hidden' name='index' value='{$index}'>";
                            echo "<button type='submit' class='cta-button'>Eliminar</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No hay productos en el carrito.</p>";
                    }
                }
                ?>
            </div>
            <div class="cart-summary text-center">
                <h2>Resumen del Pedido</h2>
                <p>Subtotal + IVA: <span id="subtotal" class="price"><?php echo number_format($subtotal, 2); ?></span>€</p>
                <p>Envío: +5€</p>
                <p><strong>Total: <span id="total" class="price"><?php echo number_format($subtotal + 5, 2); ?>€</span></strong></p>
                <br><br>
                <form method="POST" action="factura.php">
                    <?php
                    foreach ($_SESSION['cart'] as $index => $product) {
                        echo "<input type='hidden' name='products[{$index}][id]' value='{$product['id']}'>";
                        echo "<input type='hidden' name='products[{$index}][name]' value='{$product['name']}'>";
                        echo "<input type='hidden' name='products[{$index}][price]' value='{$product['price']}'>";
                    }
                    ?>
                    <button type="submit" class="cta-button-pay" <?php echo $cart_empty ? 'disabled' : ''; ?>>Proceder al Pago</button>
                </form>
                <p>Hora actual: <?php echo date("d/m/Y H:i:s"); ?></p> 
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AliMorillas. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
