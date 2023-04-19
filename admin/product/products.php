<?php
include '../../config.php';
User::isAuthorizedAdminUser();
$action = $_GET['action']?? 'list';
switch ($action) {
    case 'deleteProduct';
        if (Product::deleteProduct($_GET['id'])) {
            $_SESSION['msg'] = 'product deleted';
            header('location:' . SITE_WS_PATH . '/admin/product/products.php');
        }
        break;
    case 'createProduct':
        $product = new Product;
        $product->title = $_POST['title'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->catID = $_POST['cat_id'];
        $product->image = $product->uploadImage('image');
        if ($product->create()) {
            $_SESSION['msg'] = 'created product';
            header('location:' . SITE_WS_PATH . '/admin/product/products.php');
            exit;
        }
        break;
    case 'updateProduct':
        $product = new Product;
        $product->title = $_POST['title'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->catID = $_POST['cat_id'];
        $product->image = $product->uploadImage('image', true);
        if ($product->updateProduct($_GET['id'])) {
            $_SESSION['msg'] = 'product updated';
            header('location:' . SITE_WS_PATH . '/admin/product/products.php');
            exit;
        } else {
            $_SESSION['msg'] = 'error in updating';
        }
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= SITE_WS_PATH . '/admin/assets/style.css' ?>">

</head>

<body>
    <?php include '../templates/header.php' ?>
    <div class="container mt-5">
        <?php include '../templates/message.php' ?>
        <div class="d-flex justify-content-between align-item-center">
            <h1>Products</h1>
            <a href="<?= SITE_WS_PATH . '/admin/product/products.php?view=create' ?>" class="btn btn-primary">create product</a>
        </div>
    </div>
    <?php
    $view = $_GET['view'] ?? 'list';
    switch ($view) {
        case 'create':
            include './create.php';
            break;
        case 'edit':
            include './edit.php';
        case 'list':
        default:
            include './list.php';
            break;
    }
    ?>

    <?php include '../templates/footer.php' ?>
</body>

</html>