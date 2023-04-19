<?php
$product = Product::getProduct($_GET['id']);
?>
<div class="container">
    <h5>Edit Product</h5>
    <form action="<?= SITE_WS_PATH . '/admin/product/products.php?action=updateProduct&id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td><input type="text" name="title" placeholder="title" required class="form-control" value="<?= $product['title'] ?>"></td>
            </tr>
            <tr>
                <td><textarea name="description" id="" cols="30" rows="10" class="form-control" required placeholder="description"><?= $product['description'] ?></textarea></td>
            </tr>
            <tr>
                <td><input type="number" min="0" name="price" placeholder="price" class="form-control" value="<?= $product['price'] ?>"></td>
            </tr>
            <tr>
                <td><input type="file" name="image" placeholder="image">
                    <br />
                    <?php
                    if (file_exists(PRODUCT_IMAGES_FS_PATH . $product['image'])) { ?>
                        <img src="<?= PRODUCT_IMAGES_WS_PATH . $product['image'] ?>" width="100" />
                    <?php   }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="cat_id" id="" class="form-control">
                        <optgroup label="select any category">
                            <?php
                            $category = Category::getAllCategory();
                            if ($category) {
                                foreach ($category as $cat) { ?>
                                    <option <?= $cat['id'] == $product['cat_id'] ? 'selected' : ''; ?> value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>


                            <?php }
                            }
                            ?>

                        </optgroup>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button type="submit" class="btn btn-primary">save</button></td>
            </tr>
        </table>
    </form>
</div>