<?php
include './config.php';
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
        $catID = $_REQUEST['cat_id'];
        $cat = Category::getCategory($catID);
        ?>
        <h1>Category:<?= $cat['title'] ?></h1>
        <div class="row row-cols-4">
            <?php
            $product = Product::getAllProduct($catID);
            if ($product) {
                foreach ($product as $pro) {
            ?>
                    <div class="cols mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="<?=PRODUCT_IMAGES_WS_PATH.$pro['image']?>" class="card-img-top" alt="<?=$pro['title']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$pro['title']?></h5>
                                <p class="card-text"><?=substr($pro['description'],0,4).'....';?></p>
                                <a href="<?=SITE_WS_PATH.'/products-detail.php?id='.$pro['id']?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>

                    </div>
            <?php   }
            }


            ?>
        </div>

    </div>
    <?php include './templates/footer.php' ?>
</body>

</html>