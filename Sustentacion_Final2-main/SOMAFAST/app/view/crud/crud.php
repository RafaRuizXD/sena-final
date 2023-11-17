<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD View</title>
</head>
<?php include('../assets/view/header.php'); 
include('../assets/css/css.php'); 
include('../assets/js/js.php');?>
<body>
    <h1>Product CRUD</h1>
<?php

include('../../controller/crud.php');

?>

<br><br><br>
<form action="../../controller/crud.php" method="post">

    <button type="submit" class="btn btn-primary"><a href="../crud/add/add_product.php" style="text-decoration: none; color:white;" >Agregar</a></button>
<!--     <button type="submit"><a href="../crud/add/add_product.php">Agregar Producto</a></button> -->
</form>

    <!-- Lista de productos -->
    <h2>Lista de Productos</h2>
    <ul>
        <?php
        $crud = new Crud($conn);
        $products = $crud->readProducts();

        foreach ($products as $product) {
            echo "<li>{$product['Name']} - 
                    <a href='../crud/edit/edit.product.php?action=edit&id={$product['Id']}'>Editar</a> - 
                    <a href='../crud/delete/delete_product.php?action=delete&id={$product['Id']}'>Eliminar</a> - 
                    <a href='../crud/read/read_product.php?action=review&id={$product['Id']}'>Revisar</a></li>";
            // Puedes mostrar más detalles aquí según tu tabla
        }
        ?>
    </ul>
    <!-- Formulario para actualizar un producto -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $productId = $_GET['id'];
        $productData = $crud->getProductById($productId);

        if ($productData) {
            ?>
            <h2>Editar Producto</h2>
            <form action="../../controller/crud.php" method="post">
                <input type="hidden" name="id" value="<?php echo $productId; ?>">
                <label for="name">Nombre:</label>
                <input type="text" name="name" value="<?php echo $productData['Name']; ?>" required>
                <!-- Agrega más campos según tu tabla de productos -->

                <button type="submit">Actualizar Producto</button>
            </form>
            <?php
        }
    }
    ?>

    <!-- Formulario para eliminar un producto -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $productId = $_GET['id'];
        $productData = $crud->getProductById($productId);

        if ($productData) {
            ?>
            <h2>Eliminar Producto</h2>
            <form action="../../controller/crud.php" method="post">
                <input type="hidden" name="id_delete" value="<?php echo $productId; ?>">

                <p>¿Estás seguro de que deseas eliminar el producto "<?php echo $productData['Name']; ?>"?</p>

                <button type="submit"><a href="../crud/read/read_products.php">Eliminar Producto</a></button>
            </form>
            <?php
        }
    }
    ?>

    <!-- Mostrar detalles de un producto -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'view') {
        $productId = $_GET['id'];
        $productData = $crud->getProductById($productId);

        if ($productData) {
            ?>
            <h2>Detalles del Producto</h2>
            <p>Nombre: <?php echo $productData['Name']; ?></p>
            <p>Descripción: <?php echo $productData['Description']; ?></p>
            <!-- Agrega más detalles según tu tabla de productos -->
            <?php
        }
    }
    ?>

    <!-- Revisar un producto -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'review') {
        $productId = $_GET['id'];
        $productData = $crud->getProductById($productId);

        if ($productData) {
            ?>
            <h2>Revisar Producto</h2>
            <p>Nombre: <?php echo $productData['Name']; ?></p>
            <p>Descripción: <?php echo $productData['Description']; ?></p>
            <!-- Agrega más detalles según tu tabla de productos -->
            <?php
        }
    }
    ?>
</body>
</html>
