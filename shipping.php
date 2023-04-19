<?php
include './config.php';
$action = $_GET['action'] ?? 'null';
switch ($action) {
    case 'deleteAddress':
        Address::deleteAddress($_REQUEST['id']);
        $_SESSION['msg'] = 'deleted address';
        header('location:' . SITE_WS_PATH . '/shipping.php');
        exit;
        break;
    case 'saveShipBillAddress':        
        $addressId = $_REQUEST['address'];        
        orderprocess::createOrder($addressId);
        $_SESSION['msg'] = 'order procced';
        header('location:' . SITE_WS_PATH . '/payment.php');
        exit;
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
    <!-- fancybox  -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?= SITE_WS_PATH . '/assets/js/fancybox/jquery.fancybox.js' ?>"></script>
    <link rel="stylesheet" href="<?= SITE_WS_PATH . '/assets/js/fancybox/jquery.fancybox.css' ?>">
</head>

<body>
    <?php include './templates/header.php' ?>
    <?php include './message.php' ?>
    <div class="container">
        <h1>Chosse Billing/Shipping Address</h1>
        <div class="text-end">
            <a class="btn btn-primary btn-sm btnAddShipping" href="<?= SITE_WS_PATH . '/shipping-add.php' ?>" data-fancybox data-type='iframe'>
                Add New Address
            </a>
        </div>
        <form action="<?= SITE_WS_PATH . '/shipping.php?action=saveShipBillAddress' ?>" method="post">
            <div class="row row-cols-4">
                <?php
                $Address = Address::getAllAddress($_SESSION['user']['id']);
                if ($Address) {
                    foreach ($Address as $add) {
                ?>
                        <div class="col">
                            <div class="card">
                                <div class=" card-header">
                                    <?= $add['address_line1'] ?>
                                    <div class="float-end">
                                        <input type="radio" name="address" value="<?= $add['id'] ?>">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?= $add['address_line1'] ?>,</br>
                                    <?= $add['address_line2'] ?>,</br>
                                    <?= $add['city'] ?>,</br>
                                    <?= $add['state'] ?>,</br>
                                    <?= $add['country'] ?>,</br>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= SITE_WS_PATH . '/shipping.php?action=deleteAddress&id=' . $add['id'] ?>" class="btn btn-primary">Delete</a>
                                </div>

                            </div>

                        </div>
                <?php       }
                }
                ?>
            </div>
            <div class="row border mb-3 py-3">
                <div class="col">
                    <span class="float-end">
                        <button class="btn btn-primary" type="submit">Proceeed</button>
                    </span>
                </div>

            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnAddShipping').fancybox({
                iframe: {
                    css: {
                        width: 800,
                        height: 600
                    }
                },
                afterClose: function() {
                    window.location.reload();
                }
            });
        });
    </script>

    <?php include './templates/footer.php' ?>
</body>

</html>