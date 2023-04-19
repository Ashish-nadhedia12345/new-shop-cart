<div class="container">
    <h5>Create Product</h5>
    <form action="<?= SITE_WS_PATH . '/admin/product/products.php?action=createProduct' ?>" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td><input type="text" name="title" placeholder="title" required class="form-control"></td>
            </tr>
            <tr>
                <td><textarea name="description" id="" cols="30" rows="10" class="form-control" required placeholder="description"></textarea></td>
            </tr>
            <tr>
                <td><input type="number" min="0" name="price" placeholder="price" class="form-control"></td>
            </tr>
            <tr>
                <td><input type="file" name="image" placeholder="image" class="form-control"></td>
            </tr>
            <tr>
                <td>
                    <select name="cat_id" id="" class="form-control">
                        <optgroup label="select any category">
                            <?php
                            $category = Category::getAllCategory();
                            if ($category) {
                                foreach ($category as $cat) {
                            ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                            <?php }
                            }
                            ?>

                        </optgroup>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button class="btn btn-primary">save</button></td>
            </tr>
        </table>
    </form>
</div>