<div class="container">
    <h5>Edit Category</h5>
    <?php
    $category = Category::getCategory($_GET['id']);
    ?>
    <form action="<?= SITE_WS_PATH . '/admin/category/categories.php?action=updateCategory&id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td><input type="text" name="title" placeholder="title" required class="form-control" value="<?= $category['title'] ?>"></td>
            </tr>
            <tr>
                <td><textarea name="description" id="" cols="30" rows="10" class="form-control" required placeholder="description"><?= $category['description'] ?></textarea></td>
            </tr>
            <tr>
                <td><input type="file" name="image" placeholder="image">
                    <br />
                    <?php
                    if (file_exists(PRODUCT_IMAGES_FS_PATH . $category['image'])) { ?>
                        <img src="<?= PRODUCT_IMAGES_WS_PATH . $category['image'] ?>" width="100" />
                    <?php   }
                    ?>
                </td>
            </tr>
            <tr>
                <td><button type="submit" class="btn btn-primary">save</button></td>
            </tr>
        </table>
    </form>
</div>