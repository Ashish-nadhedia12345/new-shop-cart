<?php
include './config.php';
User::isAuthorizedUser();
$action = $_REQUEST['action'] ?? 'null';
switch ($action) {
    case 'removefromcart':
        $id = $_REQUEST['id'];
        orderprocess::removefromcart($id);
        $_SESSION['msg'] = ' Item remove from cart';
        header('location:' . SITE_WS_PATH . '/cart.php');
        exit;
        break;
    case 'updatecart':
        $id = $_REQUEST['id'];
        $qty = $_REQUEST['qty'];
        OrderProcess::updatecart($id, $qty);
        $_SESSION['msg'] = "Item updated in cart";
        header('location: ' . SITE_WS_PATH . '/cart.php');
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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include './templates/header.php' ?>
    <?php include './message.php' ?>
    <div class="container mt-4">
        <h1>Your Cart</h1>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-end">Product</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Qty</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dbo = DBO::getDBO();
                $sql = "SELECT * FROM `cart` WHERE `user_id`='" . $_SESSION['user']['id'] . "'";
                $result = mysqli_query($dbo, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $total = 0.00;
                    $gTotal = 0.00;
                    while ($item = mysqli_fetch_assoc($result)) {
                        $product = Product::getProduct($item['product_id']);
                        $total = $item['qty'] * $item['price'];
                        $gTotal += $total;
                ?>
                        <tr>
                            <td class="text-end"><?= $product['title'] ?></td>
                            <td class="text-end"><?= DBO::showAsCurrency($item['price']) ?></td>
                            <td class="text-end">
                                <form action="<?= SITE_WS_PATH . '/cart.php?action=updatecart&id=' . $item['id'] ?>" method="post"><input type="number" name="qty" value="<?= $item['qty'] ?>"><button type="submit" class="btn btn-sm"><i class="bi bi-pencil"></i></button>

                                </form>
                            </td>
                            <td class="text-end"><?= DBO::showAsCurrency($total) ?></td>
                            <td class="text-end">
                                <a title="Remove from cart" href="<?= SITE_WS_PATH . '/cart.php?action=removefromcart&id=' . $item['id'] ?>"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                <?php     }
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end">
                        <strong>Grand Total</strong>
                    </td>
                    <td class="text-end"><?= DBO::showAsCurrency($gTotal) ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end">
                        <a class="btn btn-primary btn-sm" href="<?=SITE_WS_PATH.'/shipping.php'?>">Proced To Checkout</a>
                    </td>
                </tr>

            </tfoot>
        </table>

    </div>
    <?php include './templates/footer.php' ?>
</body>

</html>