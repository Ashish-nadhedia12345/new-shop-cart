<?php
include '../config.php';
User::isAuthorizedAdminUser();
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
    <link rel="stylesheet" href="<?=SITE_WS_PATH.'/admin/assets/style.css'?>">
    
</head>

<body>
    <?php include './templates/header.php' ?>
    <div class="container mt-5">
        <?php include './templates/message.php'?>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae ut sint magnam suscipit officiis officia tempore iure explicabo inventore? Ratione consequuntur minus, odio cum dignissimos animi! Quis nam omnis autem porro amet dolores veritatis quaerat necessitatibus ea voluptates. Maxime quasi architecto animi numquam ad natus ex magnam nihil. At fuga itaque soluta facere tempora corporis, nesciunt nihil, maxime ipsum saepe odit? Eum asperiores, alias fugit necessitatibus, in cupiditate deserunt porro molestias, corporis possimus quasi perspiciatis reprehenderit quis beatae nisi dolores quia neque nemo itaque aliquam esse laborum quae quibusdam. Nobis repudiandae deserunt dignissimos ex magni laboriosam odio perferendis dolores ducimus.</p>
    </div>
    <?php include './templates/footer.php' ?>
</body>

</html>