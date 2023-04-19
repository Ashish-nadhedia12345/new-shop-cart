<?php
include './config.php';
if(isset($_REQUEST['AddtoCart'])){
    $qty=$_REQUEST['qty'];
    $productId=$_REQUEST['product_id'];
    $msg=OrderProcess::AddtoCart($productId,$qty);
    $_SESSION['msg']=$msg;
    header('location:'.SITE_WS_PATH.'/products-detail.php?id='.$productId);
    exit;
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
</head>

<body>
    <?php include './templates/header.php' ?>
    <?php include './message.php' ?>
    <div class="container">
        <?php
        $pro = Product::getProduct($_REQUEST['id']);
        ?>
        <h1><?= $pro['title'] ?></h1>
        <div class="d-flex justify-content-between">
            <img src="<?= PRODUCT_IMAGES_WS_PATH . $pro['image'] ?>" width="800" class="rounded" alt="">
            <div class="card" style="width:18rem">
                <div class="card-body">
                    <h5 class="card-title"><?= $pro['title'] ?></h5>
                    <p class="card-text"><?= $pro['description'] ?></p>
                    <p class="card-text">$<?= $pro['price'] ?></p>
                </div>
                <div class="card-footer">
                    <form action="" method="post">
                    <input type="hidden" name="product_id" value="<?=$pro['id']?>">
                        <div class="row">
                            <div class="col-6"><input type="number" class="form-control" name="qty" min="1" value="1"></div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary" name="AddtoCart">Add to Cart</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <?php include './templates/footer.php' ?>
</body>

</html>