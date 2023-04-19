<?php
$category = Category::getAllCategory();
if ($category) {
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
            <?php foreach ($category as $cat) { ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= $cat['title'] ?></td>
                    <td><img src="<?= PRODUCT_IMAGES_WS_PATH . $cat['image'] ?>" width="50" class="img-thumbnail"></td>
                    <td>
                        <a href="<?= SITE_WS_PATH . '/admin/category/categories.php?view=edit&id=' . $cat['id'] ?>"><i class="bi bi-pencil"></i></a>
                        <a href="<?= SITE_WS_PATH . '/admin/category/categories.php?action=deleteCategory&id=' . $cat['id'] ?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
</div>