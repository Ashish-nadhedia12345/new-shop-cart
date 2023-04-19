<?php
$product = Product::getAllProduct();
if ($product) {
?>
<div class="container">
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $pro) { ?>
                <tr>
                    <td><?= $pro['id'] ?></td>
                    <td><?= $pro['title'] ?></td>
                    <td><img src="<?= PRODUCT_IMAGES_WS_PATH . $pro['image'] ?>" width="50" class="img-thumbnail"></td>
                    <td>
                        <a href="<?= SITE_WS_PATH . '/admin/product/products.php?view=edit&id=' . $pro['id'] ?>"><i class="bi bi-pencil"></i></a>
                        <a href="<?= SITE_WS_PATH . '/admin/product/products.php?action=deleteProduct&id=' . $pro['id'] ?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
</div>